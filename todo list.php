<?php


include('config.php');
session_start();
// Vérification si l'utilisateur est connecté
if (isset($_SESSION['username'])) {
  // Récupération des informations de l'utilisateur connecté depuis la base de données
  $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
  $stmt->execute(['username' => $_SESSION['username']]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);


} else {
  // Redirection vers la page de connexion
  header('Location: login.php');
  exit();
}


if (date("H") < 18)
$bienvenue = "bonjour et bienvenue " .
$_SESSION['username'];
else 
$bienvenue = "bonsoir et bienvenue " .
$_SESSION['username'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>todo list</title>
</head>
<body>
    
</body>
</html>