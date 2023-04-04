<?php
// Inclusion du fichier de configuration de la base de données
include('config.php');

session_start();



// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['username'])) {
        // Rediriger l'utilisateur vers la page de connexion
        header('Location: login.php');
        exit;
    }

}

// Récupérer les tâches de la base de données et les afficher dans un tableau
$stmt = $pdo->query('SELECT * FROM tasks ORDER BY id DESC');
$tasks = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Liste des tâches</title>
</head>
<body>
    <h1>Liste des tâches</h1>

    <?php if (count($tasks) > 0) { ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasks as $task) { ?>
                    <tr>
                        <td><?php echo $task['id']; ?></td>
                        <td><?php echo $task['title']; ?></td>
                        <td><?php echo $task['description']; ?></td>
                        <td>
                            <form method="post" id="update">
                                <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                                <input type="text" name="title" value="<?php echo $task['title']; ?>">
                                <textarea name="description"><?php echo $task['description']; ?></textarea>
                                <button type="submit">Modifier</button>
                            </form>
                            <script src="update.js"></script>

                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>Aucune tâche n'a été trouvée.</p>
    <?php } ?>


</body>
</html>


