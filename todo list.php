<?php
// Inclusion du fichier de configuration de la base de données
include('config.php');
include('user.php');



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

    <?php if (isset($error)) { ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php } ?>


    <form method="post">
        <label for="title">Titre :</label>
        <input type="text" id="title" name="title"><br>
        <label for="description">Description :</label>
        <textarea id="description" name="description"></textarea><br>
        <button type="submit">Ajouter la tâche</button>
    </form>

    <?php if (!empty($tasks)) { ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasks as $task) { ?>
                    <tr>
                        <td><?php echo $task['id']; ?></td>
                        <td><?php echo $task['title']; ?></td>
                        <td><?php echo $task['description']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>Aucune tâche n'a été trouvée.</p>
    <?php } ?>
</body>
</html>

