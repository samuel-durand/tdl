<?php

include('config.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer l'ID de la tâche à marquer comme terminée
    $task_id = $_POST['task_id'];

    // Récupérer les données de la tâche
    $stmt = $pdo->prepare('SELECT * FROM tasks WHERE id = :task_id');
    $stmt->bindParam(':task_id', $task_id, PDO::PARAM_INT);
    $stmt->execute();
    $task = $stmt->fetch();

    // Mettre à jour la tâche comme terminée
    $stmt = $pdo->prepare('UPDATE tasks SET complete = 1 WHERE id = :task_id');
    $stmt->bindParam(':task_id', $task_id, PDO::PARAM_INT);
    $stmt->execute();

    // Récupérer le titre et la description de la tâche
    $task_title = $task['title'];
    $task_description = $task['description'];

    // Afficher un message de confirmation
    echo "La tâche '{$task_title}' : '{$task_description}' a été marquée comme terminée.";
}

?>
