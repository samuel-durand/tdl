  // Sélection de l'élément du formulaire et ajout d'un écouteur d'événements sur la soumission
  document.querySelector('#complete').addEventListener('submit', (event) => {
    event.preventDefault(); // Empêche le rechargement de la page
  
    // Récupération des données du formulaire
    const formData = new FormData(event.target);
  
    // Envoi de la requête
    fetch('complete.php', {
      method: 'POST',
      body: formData
    })
    .then(response => {
      // Redirection vers la page désirée
      window.location.replace("todolist.php");
    })
    .catch(error => {
      console.error(error);
    });
  });