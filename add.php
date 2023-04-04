<?php
    include('config.php');

if (isset($_POST['title']) && isset($_POST['description'])) {
    $title = htmlspecialchars($_POST['title'], ENT_QUOTES);
    $description = htmlspecialchars($_POST['description'], ENT_QUOTES);
  
    // Récupérer l'ID de l'utilisateur connecté à partir de la variable de session
    $user_id = $_SESSION['user_id'];
  
    // Requête d'insertion avec jointure INNER JOIN sur la table "users"
    $stmt = $pdo->prepare('INSERT INTO tasks (title, description, user_id) VALUES (:title, :description, :user_id)');
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':description', $description, PDO::PARAM_STR);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
  
    $task_id = $pdo->lastInsertId(); // Récupérer l'ID de la tâche insérée
    $stmt_task = $pdo->prepare('SELECT * FROM tasks WHERE id = :id');
    $stmt_task->bindParam(':id', $task_id, PDO::PARAM_INT);
    $stmt_task->execute();
    $task = $stmt_task->fetch();
  
    var_dump($task); // Afficher les informations sur la tâche ajoutée
}
?> 
