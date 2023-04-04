<?php
// Inclusion du fichier de configuration de la base de données
include('config.php');

// Vérification si les données ont été soumises
if (isset($_POST['username']) && isset($_POST['password'])) {
  // Récupération des données soumises dans le formulaire
  $username = htmlspecialchars($_POST['username'], ENT_QUOTES) ;
  $password = htmlspecialchars($_POST['password'], ENT_QUOTES);

  // Recherche de l'utilisateur correspondant dans la base de données
  $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
  $stmt->execute(['username' => $username]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  // Vérification si l'utilisateur n'existe pas déjà
  if (!$user) {
    // Insertion de l'utilisateur dans la base de données
    $stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
    $stmt->execute(['username' => $username, 'password' => password_hash($password, PASSWORD_DEFAULT)]);

    exit();
  } else {
    // Si l'utilisateur existe déjà, on affiche un message d'erreur
    echo 'L\'utilisateur existe déjà.';
  }
}


?>