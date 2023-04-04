<?php
// Se connecter à la base de données
include('config.php');
// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $task_id = $_POST['task_id'];
    $title = htmlspecialchars($_POST['title'], ENT_QUOTES);
    $description = htmlspecialchars($_POST['description'], ENT_QUOTES);

    // Préparer la requête de mise à jour
    $stmt = $pdo->prepare('UPDATE tasks SET title = :title, description = :description WHERE id = :task_id');

    // Lier les valeurs aux paramètres de la requête
    $stmt->bindParam(':task_id', $task_id, PDO::PARAM_INT);
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':description', $description, PDO::PARAM_STR);

    // Exécuter la requête
    $stmt->execute();

    // Afficher un message de confirmation
    echo "La tâche a été mise à jour avec succès.";
}


?>