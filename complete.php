<?php

include('config.php');

date_default_timezone_set("Europe/Paris");


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer l'ID de la tâche à marquer comme terminée
    $task_id = $_POST['task_id'];

    // Récupérer les données de la tâche
    $stmt = $pdo->prepare('SELECT * FROM tasks WHERE id = :task_id');
    $stmt->bindParam(':task_id', $task_id, PDO::PARAM_INT);
    $stmt->execute();
    $task = $stmt->fetch();

    // Mettre à jour la tâche comme terminée et ajouter la date de fin
    $now = date('Y-m-d H:i:s');
    $stmt = $pdo->prepare('UPDATE tasks SET complete = 1, date = date_end, date_end = :now WHERE id = :task_id');
    $stmt->bindParam(':task_id', $task_id, PDO::PARAM_INT);
    $stmt->bindParam(':now', $now, PDO::PARAM_STR);
    $stmt->execute();

    // Récupérer le titre et la description de la tâche
    $task_title = $task['title'];
    $task_description = $task['description'];
    $task_date_end = $now;

    // Afficher un message de confirmation
    echo "La tâche '{$task_title}' : '{$task_description}' a été marquée comme terminée à '{$task_date_end}'.";
}

?>


