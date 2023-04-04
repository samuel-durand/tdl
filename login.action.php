<?php

// Inclusion du fichier de configuration de la base de données
include('config.php');

// Démarrage de la session
session_start();

// Vérification si les données ont été soumises
if (isset($_POST['username']) && isset($_POST['password'])) {
  // Récupération des données soumises dans le formulaire
  $username = htmlspecialchars($_POST['username'], ENT_QUOTES) ;
  $password = htmlspecialchars($_POST['password'], ENT_QUOTES);

  // Recherche de l'utilisateur correspondant dans la base de données
  $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
  $stmt->execute(['username' => $username]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  // Vérification si l'utilisateur a été trouvé et que le mot de passe est correct
  if ($user && password_verify($password, $user['password'])) {
    // Sauvegarde de l'utilisateur connecté dans la session
    $_SESSION['username'] = $username;

    // Affichage du message de bienvenue
    echo 'Bienvenue, ' . $username . ' !';
  } else {
    // Affichage du message d'erreur
    echo 'Mauvais login ou mot de passe.';
  }
}

?>

