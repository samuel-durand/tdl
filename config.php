<?php 


// Paramètres de connexion à la base de données
$dsn = 'mysql:host=localhost;dbname=todo list';
$username = 'root';
$password = '';

// Connexion à la base de données en utilisant PDO
try {
    $pdo = new PDO($dsn, $username, $password);
  } catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
    exit();
  }


?>