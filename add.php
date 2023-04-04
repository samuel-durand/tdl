<?php
    include('config.php');

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['username'])) {
        // Rediriger l'utilisateur vers la page de connexion
        header('Location: login.php');
        exit;
    }

    // Récupérer l'ID de l'utilisateur connecté
    $user_id = $_SESSION['username'];

    // Récupérer les données du formulaire
    $title = htmlspecialchars($_POST['title'], ENT_QUOTES);
    $description = htmlspecialchars($_POST['description'], ENT_QUOTES);



    // Préparer la requête d'insertion
    $stmt = $pdo->prepare('INSERT INTO tasks (user_id, title, description) VALUES (:user_id, :title, :description)');

    // Lier les valeurs aux paramètres de la requête
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':description', $description, PDO::PARAM_STR);

    // Exécuter la requête
    $stmt->execute();

    // Afficher un message de confirmation
    echo "La tâche a été ajoutée avec succès.";
}
?> 
