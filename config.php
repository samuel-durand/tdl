<?php 

session_start();

// Paramètres de connexion à la base de données
$dsn = 'mysql:host=localhost;dbname=samuel-durand_tdl';
$username = 'samuel';
$password = 'Zgcl059%2';

// Connexion à la base de données en utilisant PDO
try {
    $pdo = new PDO($dsn, $username, $password);
  } catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
    exit();
  }


?>