<?php




// Démarrer la session
session_start();

include('config.php');



// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $title = htmlspecialchars($_POST['title'], ENT_QUOTES);
    $description = htmlspecialchars($_POST['description'], ENT_QUOTES);
    $complete = isset($_POST['complete']) ? 1 : 0;

    // Se connecter à la base de données

    // Récupérer l'ID de l'utilisateur connecté
    $stmt = $pdo->prepare('SELECT id FROM users WHERE username = :username');
    $stmt->bindParam(':username', $_SESSION['username'], PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $user_id = $user['id'];

    // Préparer la requête d'insertion
    $stmt = $pdo->prepare('INSERT INTO tasks (user_id, title, description, complete) VALUES (:user_id, :title, :description, :complete)');

    // Lier les valeurs aux paramètres de la requête
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':description', $description, PDO::PARAM_STR);
    $stmt->bindParam(':complete', $complete, PDO::PARAM_BOOL);

    // Exécuter la requête
    $stmt->execute();

    // Afficher un message de confirmation
    echo "La tâche a été ajoutée avec succès.";
}


  
?> 
