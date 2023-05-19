import json
from unittest.mock import MagicMock
import pytest
from scriptTraitement import backup, backupSinceDate, getAllPhotosByAlbum, jsonBackup, jsonBackupAlbum, jsonBackupWithTag, searchWithTagsInsideTitle

#Création d'un mock objet pour les tests
@pytest.fixture
def flickr_mock(mocker):

    with open('jsonTests/backup_photos.json', 'r') as j:
        jsonPhotos = json.load(j)
    
    with open('jsonTests/backup_album_photos.json', 'r') as j:
        jsonAlbumPhotos = json.load(j)

    with open('jsonTests/album_list_api_response.json', 'r') as j:
        jsonAlbumApiResponse = json.load(j)
    
    with open('jsonTests/backup_photos_FRB1234.json', 'r') as j:
        jsonTagPhotos = json.load(j)

    flickr_mock = MagicMock(name='flickr')

    flickr_mock.people.getPhotos.return_value = {
        'photos': {
            'id': '72177720305968286',
            'owner': '197662816@N03',
            'ownername': 'LorysM13',
            'page': 1,
            'pages': 1,
            'per_page': 500,
            'perpage': 500,
            'photo': jsonPhotos
        }
    }
    flickr_mock.photosets.getList.return_value = {
        'photosets': jsonAlbumApiResponse,
        'stat': 'ok'
    }
    flickr_mock.photosets.getPhotos.return_value = {
        'photoset': {
            'photo': jsonAlbumPhotos
        }
    }
    flickr_mock.photos.search.return_value = {
        'photos': {
            'id': '72177720305968286',
            'owner': '197662816@N03',
            'ownername': 'LorysM13',
            'page': 1,
            'pages': 1,
            'per_page': 500,
            'perpage': 500,
            'photo': jsonTagPhotos
        }
    }
    return flickr_mock

#Test pour vérifier que la backup complète fonctionne
def test_backup(flickr_mock):
    result = backup(flickr=flickr_mock)
    assert len(result) == len(flickr_mock.people.getPhotos.return_value['photos']['photo'])
    for i in range(len(result)):
        assert result[i]['title'] == flickr_mock.people.getPhotos.return_value['photos']['photo'][i]['title']
        assert result[i]['url'] == flickr_mock.people.getPhotos.return_value['photos']['photo'][i]['url']

#Test pour vérifier que si l'utilisateur entre une date correcte, le script récupère les photos
def test_backupSinceDate_valid(flickr_mock):
    result = backupSinceDate("10-01-2023", flickr=flickr_mock)
    assert len(result) == len(flickr_mock.people.getPhotos.return_value['photos']['photo'])
    for i in range(len(result)):
        assert result[i]['title'] == flickr_mock.people.getPhotos.return_value['photos']['photo'][i]['title']
        assert result[i]['url'] == flickr_mock.people.getPhotos.return_value['photos']['photo'][i]['url']

#Test pour vérifier que si l'utilisateur entre une date invalide, le script affiche une erreur
def test_backupSinceDate_invalid(flickr_mock):
    with pytest.raises(ValueError, match=r"%d-%m-%Y"):
        backupSinceDate("10012023",flickr_mock)

#Test pour vérifier que la backup en json fonctionne
def test_searchWithTagsInsideTitle(flickr_mock):
    result = searchWithTagsInsideTitle(tag="FRB1234",flickr=flickr_mock)
    assert len(result) == len(flickr_mock.photos.search.return_value['photos']['photo'])
    for i in range(len(result)):
        assert result[i]['title'] == flickr_mock.photos.search.return_value['photos']['photo'][i]['title']
        assert result[i]['url'] == flickr_mock.photos.search.return_value['photos']['photo'][i]['url']

#Test pour vérifier la récupération des photos par album avec un existant
def test_backupAlbum_valid(flickr_mock):
    result = getAllPhotosByAlbum(album_name="Joestar",flickr=flickr_mock)
    assert len(result) == len(flickr_mock.photosets.getPhotos.return_value['photoset']['photo'])
    for i in range(len(result)):
        assert result[i]['title'] == flickr_mock.photosets.getPhotos.return_value['photoset']['photo'][i]['title']
        assert result[i]['url'] == flickr_mock.photosets.getPhotos.return_value['photoset']['photo'][i]['url']

#Test pour vérifier la récupération des photos par album qui n'existe pas
def test_backupAlbum_invalid(flickr_mock):
    result = getAllPhotosByAlbum(album_name="NAM-IP",flickr=flickr_mock)
    assert len(result) != len(flickr_mock.photosets.getPhotos.return_value['photoset']['photo']) and not result

#Test pour vérifier que la backup en json fonctionne
def test_jsonBackup(flickr_mock):
    result = jsonBackup(flickr=flickr_mock)
    assert len(result) == len(flickr_mock.people.getPhotos.return_value['photos']['photo'])
    for i in range(len(result)):
        assert result[i]['title'] == flickr_mock.people.getPhotos.return_value['photos']['photo'][i]['title']
        assert result[i]['url'] == flickr_mock.people.getPhotos.return_value['photos']['photo'][i]['url']

#Test pour vérifier que la backup en json fonctionne
def test_jsonBackupWithTag_valid(flickr_mock):
    result = jsonBackupWithTag(tag="FRB1234",flickr=flickr_mock)
    assert len(result) == len(flickr_mock.photos.search.return_value['photos']['photo'])
    for i in range(len(result)):
        assert result[i]['title'] == flickr_mock.photos.search.return_value['photos']['photo'][i]['title']
        assert result[i]['url'] == flickr_mock.photos.search.return_value['photos']['photo'][i]['url']

#Test pour vérifier la backup json par album avec un nom d'album existant
def test_backupJsonAlbum_valid(flickr_mock):
    result = jsonBackupAlbum(album_name="Joestar",flickr=flickr_mock)
    assert len(result) == len(flickr_mock.photosets.getPhotos.return_value['photoset']['photo'])
    for i in range(len(result)):
        assert result[i]['title'] == flickr_mock.photosets.getPhotos.return_value['photoset']['photo'][i]['title']
        assert result[i]['url'] == flickr_mock.photosets.getPhotos.return_value['photoset']['photo'][i]['url']

#Test pour vérifier la backup json par album avec un nom d'album inexistant
def test_backupJsonAlbum_invalid(flickr_mock):
    result = jsonBackupAlbum(album_name="NAM-IP",flickr=flickr_mock)
    assert len(result) != len(flickr_mock.photosets.getPhotos.return_value['photoset']['photo']) and not result