<?php
// Inclusion du fichier de configuration de la base de données
include('config.php');


// Vérification si les données ont été soumises
if (isset($_POST['username']) && isset($_POST['password'])) {
  // Récupération des données soumises dans le formulaire
  $username = htmlspecialchars($_POST['username'], ENT_QUOTES);
  $password = htmlspecialchars($_POST['password'], ENT_QUOTES);

  // Insertion de l'utilisateur dans la base de données
  $stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
  $stmt->execute(['username' => $username, 'password' => password_hash($password, PASSWORD_DEFAULT)]);

  // Récupération de l'identifiant généré automatiquement pour l'utilisateur nouvellement inséré
  $user_id = $pdo->lastInsertId();

  // Affichage de l'identifiant de l'utilisateur nouvellement inséré
  echo 'L\'utilisateur avec l\'identifiant ' . $user_id . ' a été inséré dans la base de données.';
}


?>