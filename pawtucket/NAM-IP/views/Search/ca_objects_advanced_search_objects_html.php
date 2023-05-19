
<div class="row">
	<div class="col-sm-8 " style='border-right:1px solid #ddd;'>
		<h1>Formulaire de recherche d'objets avancé</h1>

<?php			
print "<p>Saisissez vos termes de recherche dans les champs ci-dessous.</p>";
?>

{{{form}}}

<div class='advancedContainer'>
	<div class='row'>
		<div class="advancedSearchField col-sm-12">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Recherche dans tous les champs de la base de données.">Mots-clés</span>
			{{{_fulltext%width=200px&height=1}}}
		</div>			
	</div>		
	<div class='row'>
		<div class="advancedSearchField col-sm-12">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Limite votre recherche aux titres d'objets uniquement.">Titre</span>
			{{{ca_objects.preferred_labels.name%width=220px}}}
		</div>
	</div>
	<div class='row'>
		<div class="advancedSearchField col-sm-6">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Limite votre recherche aux identifiants d'objets uniquement.">Identifiants</span>
			{{{ca_objects.idno%width=210px}}}
		</div>
		<div class="advancedSearchField col-sm-6">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Limite votre recherche aux types d'objets uniquement.">Type</span>
			{{{ca_objects.type_id%height=30px}}}
		</div>
	</div>
	<div class='row'>
		<div class="advancedSearchField col-sm-12">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Recherche d'objets pour une date ou une fourchette de dates donnée.">Plage de dates<i>(ex: 1970-1979)</i></span>
			{{{ca_objects.dates.dates_value%width=200px&height=40px&useDatePicker=0}}}
		</div>
	</div>
	<div class='row'>
		<div class="advancedSearchField col-sm-12">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Recherche d'objets appartenant à une certaine collection.">Collection </span>
			{{{ca_collections.preferred_labels%restrictToTypes=collection%width=200px&height=40px}}}
		</div>
	</div>
	<br style="clear: both;"/>
	<div class='advancedFormSubmit'>
		<span class='btn btn-default'>{{{reset%label=Réinitialiser}}}</span>
		<span class='btn btn-default' style="margin-left: 20px;">{{{submit%label=Valider}}}</span>
	</div>
</div>	

{{{/form}}}

	</div>
	<div class="col-sm-4" >
		<h1>Liens utiles</h1>
		<p>Cet outil de recherche avancée vous permet de chercher dans des champs précis et/ou de filtrer les résultats de la recherche tous champs. Vous pouvez effectuer une recherche sur plusieurs champs simultanés. Par ailleurs, pour le titre, les mots-clés et les dates, il est possible de réaliser une recherche sur base de termes incomplets en utilisant un astérisque (*).</p>
		<h2>Descriptif des différents champs</h2>
		<p>Titre : recherche dans les mots du titre du document. Vous pouvez écrire plusieurs termes du titre dans n'importe quel ordre.</p>
		<p>Personne / Collectivité : toutes les personnes ou collectivités qui ont contribué au document : auteurs, éditeurs, imprimeurs, illustrateurs, etc.</p>
		<p>Type : recherche sur base d'un type de document particulier (monographie, affiche, dossier d'archives, etc.). La liste déroulante reprend l'ensemble des types de documents conservés au Mundaneum.</p>
		<p>Mot-clé : recherche par mot-clé.</p>
		<p>Année(s) : recherche sur base d'une année ou d'un créneau d'années. Exemples : « 1974 » (tous les documents datant de 1974), « 1974-1979 » (tous les documents dans ce créneau d'années), « 197* » (tous les documents entre 1970 et 1979), « 19** » (tous les documents entre 1900 et 1999).</p>
	</div><!-- end col -->
</div><!-- end row -->

<script>
	jQuery(document).ready(function() {
		$('.advancedSearchField .formLabel').popover(); 
	});
	
</script>