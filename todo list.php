<?php
// Inclusion du fichier de configuration de la base de données
include('config.php');
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    // Rediriger l'utilisateur vers la page de connexion
    header('Location: login.php');
    exit;
}

date_default_timezone_set("Europe/Paris");


if (date("H") < 18)
$bienvenue = "bonjour et bienvenue " .
$_SESSION['username'];
else 
$bienvenue = "bonsoir et bienvenue " .
$_SESSION['username'];


// Récupérer les tâches créées par l'utilisateur connecté
$username = $_SESSION['username'];
$stmt = $pdo->prepare('SELECT tasks.* FROM tasks INNER JOIN users ON tasks.user_id = users.id WHERE users.username = :username ORDER BY tasks.id DESC');
$stmt->bindParam(':username', $username, PDO::PARAM_STR);
$stmt->execute();
$tasks = $stmt->fetchAll();
?>

<!doctype html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>Liste des tâches</title>

    <!-- Ajoutez le lien CDN pour Tailwind ici -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.7/tailwind.min.css">
</head>

<body>

<?php include('header.php') ?>

<h3 id="welcome" class="text-light"><?php echo $bienvenue ?></h3>


<h1 class="text-3xl mb-5">Liste des tâches</h1>
<div class="tache">
    <?php 
    if (count($tasks) > 0) { 
    ?>
    <ul class="">
        <?php 
        foreach ($tasks as $task) { 
            if (!$task['complete']) { // Si la tâche n'est pas terminée, on l'affiche
        ?>
        <li class="bg-white rounded-lg shadow-lg p-6">
            <form method="post" id="update">
                <label for="">Titre :</label>
                <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                <input type="text" name="title" value="<?php echo $task['title']; ?>" class="w-full border rounded px-2 py-1 mb-2">
                <label for="">description :</label>
                <textarea name="description" class="w-full border rounded px-2 py-1 mb-2"><?php echo $task['description']; ?></textarea>
                <div class="flex justify-between items-center">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold rounded py-1 px-4">Modifier</button>
                </div>
                <script src="./update.js"></script>
            </form>

            <form method="post" id="complete">
                <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold rounded py-1 px-4 mt-2">Terminer la tâche</button>

                <div class="flex justify-center">
                    <p class="text-gray-600"><?php echo $task['date']; ?></p>
                </div>
            </form>
            <script src="complete.js"></script>
        </li>
        <?php 
            }
        } 
        ?>
    </ul>
    <?php 
    } else {
        echo "Aucune tâche trouvée.";
    }
    ?>
</div>

  <h1 id="add-list" class=" font-bold mb-4">Ajouter une liste</h1>

<div class="container">
  <form method="post" id="add" id="add-box" class="bg-white rounded-lg shadow-lg p-6">
    <div class="mb-4">
      <label for="title" class="block font-bold mb-2">Titre :</label>
      <input type="text" name="title" id="title" class="w-full border rounded py-2 px-3">
    </div>

    <div class="mb-4">
      <label for="description" class="block font-bold mb-2">Description :</label>
      <textarea name="description" id="description" class="w-full border rounded py-2 px-3"></textarea>
    </div>

    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Ajouter la liste</button>

    <script src="./add.js"></script>
  </form>
</div>





<h2 class="text-xl font-bold mb-4">Tâches terminées</h2>
<?php if (count($tasks) > 0) { ?>
    <table class="w-full border-collapse">
        <thead>
            <tr>
                <th class="border border-gray-400 px-4 py-2 text-center">ID</th>
                <th class="border border-gray-400 px-4 py-2 text-center">Titre</th>
                <th class="border border-gray-400 px-4 py-2 text-center">Description</th>
                <th class="border border-gray-400 px-4 py-2 text-center">Heure ajouter</th>
                <th class="border border-gray-400 px-4 py-2 text-center">Heure terminée</th>
                <th class="border border-gray-400 px-4 py-2 text-center">Terminée</th>
                <th class="border border-gray-400 px-4 py-2 text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tasks as $task) {
                if ($task['complete']) { ?>
                    <tr>
                        <td class="border border-gray-400 px-4 py-2 text-center"><?php echo $task['id']; ?></td>
                        <td class="border border-gray-400 px-4 py-2"><?php echo $task['title']; ?></td>
                        <td class="border border-gray-400 px-4 py-2"><?php echo $task['description']; ?></td>
                        <td class="border border-gray-400 px-4 py-2 text-center"><?php echo $task['date']; ?></td>
                        <td class="border border-gray-400 px-4 py-2 text-center"><?php echo $task['date_end']; ?></td>
                        <td class="border border-gray-400 px-4 py-2 text-center">Oui</td>
                        <td class="border border-gray-400 px-4 py-2 text-center">
                            <form method="post" id="delete"<?php echo $task['id']; ?>">
                                <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                                <button type="submit" class="bg-red-500 text-white font-bold py-2 px-4 rounded">Supprimer</button>
                            </form>
                            <script src="delete.js"></script>
                        </td>
                    </tr>
                <?php }
            } ?>
        </tbody>
    </table>
<?php } else { ?>
    <p>Aucune tâche terminée n'a été trouvée.</p>
<?php } ?>
</body>
</html>
