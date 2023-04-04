// Sélection du bouton de déconnexion et ajout d'un écouteur d'événements sur le clic
document.querySelector('#btn-deconnexion').addEventListener('click', (event) => {
    event.preventDefault(); // Empêche le comportement par défaut du bouton
    
    // Envoi de la requête
    fetch('logout.php')
    .then(response => {
      // Redirection vers la page de connexion
      window.location.replace("login.php");
    })
    .catch(error => {
      console.error(error);
    });
  });