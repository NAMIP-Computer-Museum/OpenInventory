import flickrapi

#Clé publique de l'api
FLICKR_PUBLIC = 'a3e4e529a8580f9c25c9fe07bfddb60c'
#Clé secrète de l'api
FLICKR_SECRET = '908974b10c758cde'

#Connection sur notre profil flicker
flickr = flickrapi.FlickrAPI(FLICKR_PUBLIC, FLICKR_SECRET, format='parsed-json')
# Authentification à l'aide d'OAuth et demande d'uniquement des permissions de lecture
flickr.get_request_token(oauth_callback='oob')
authUrl = flickr.auth_url(perms='read')

#Vérification avec le mot de passe reçu par l'utilisateur
print("Ouvrez cette URL pour vous authentifier: ", authUrl)
resultCode = input("Entrez le code d'authentification obtenu : ")
flickr.get_access_token(resultCode)
