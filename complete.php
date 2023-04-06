<?php

include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['task_id'])) {
    // Récupérer l'ID de la tâche à marquer comme terminée
    $task_id = $_POST['task_id'];

    // Mettre à jour la tâche comme terminée et ajouter la date de fin
    $now = date('Y-m-d H:i:s');
    $stmt = $pdo->prepare('UPDATE tasks SET complete = 1, date_end = :now WHERE id = :task_id');
    $stmt->bindParam(':task_id', $task_id, PDO::PARAM_INT);
    $stmt->bindParam(':now', $now, PDO::PARAM_STR);
    $stmt->execute();

    // Afficher un message de confirmation
    echo "La tâche a été marquée comme terminée à '{$now}'.";
}


?>


