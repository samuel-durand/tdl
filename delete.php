<?php 
include('config.php');

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer l'ID de la tâche à supprimer
    $task_id = $_POST['task_id'];

    // Préparer la requête de suppression
    $stmt = $pdo->prepare('DELETE FROM tasks WHERE id = :task_id');

    // Lier l'ID de la tâche au paramètre de la requête
    $stmt->bindParam(':task_id', $task_id, PDO::PARAM_INT);

    // Exécuter la requête
    $stmt->execute();

    // Afficher un message de confirmation
    echo "La tâche a été supprimée avec succès.";
}



?>