window.addEventListener('scroll', function() {
  var navbar = document.getElementById('navbar');
  var currentScroll = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0; // Obtenir la position de défilement actuelle pour tous les navigateurs

  if (currentScroll > 0) {
    if (!navbar.classList.contains('sticky')) { // Vérifier si la classe 'sticky' n'est pas déjà présente
      navbar.classList.add('sticky');
      navbar.classList.add('white-text'); // Ajouter la classe 'white-text'
    }
  } else {
    if (navbar.classList.contains('sticky')) { // Vérifier si la classe 'sticky' est présente
      navbar.classList.remove('sticky');
       navbar.classList.remove('white-text'); // Supprimer la classe 'white-text'
    }
  }
})