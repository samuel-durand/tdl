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


$stmt = $pdo->query('SELECT * FROM `tasks` ORDER BY `tasks`.`complete` DESC
');
$completed_tasks = $stmt->fetchAll();




?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Liste des tâches</title>
</head>
<body>

    <h1>ajouter une tache</h1>
    <form method="post" id="add">
        <label for="title">Titre :</label>
        <input type="text" name="title" id="title">
        <br>

        <label for="description">Description :</label>
        <textarea name="description" id="description"></textarea>
        <br>

        <button type="submit">Ajouter la tâche</button>
        <script src="./add.js"></script>
    </form>
<!--<script src="./add.js"></script>-->
    <h1>Liste des tâches</h1>

    <h2>Tâches en cours</h2>
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
                            <script src="./update.js"></script>
						</form>
 

                        <form method="post" id="complete">
                        <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                         <button type="submit">Terminer la tâche</button>
                        </form>

                        <script src="complete.js"></script>
                    </form>

                    

					</td>
				</tr>

			<?php } ?>
		</tbody>
	</table>
	<?php } else { ?>
		<p>Aucune tâche en cours n'a été trouvée.</p>
	<?php } ?>

	<h2>Tâches terminées</h2>
	<?php if (count($tasks) > 0) { ?>
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Titre</th>
				<th>Description</th>
                <th>terminée</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($tasks as $task) { ?>
                <tr>
  <td><?php echo $task['id']; ?></td>
  <td class="completed"><?php echo $task['title']; ?></td>
  <td class="completed"><?php echo $task['description']; ?></td>
  <td class="completed"><?php echo $task['complete']; ?></td>
  <td>
    <form method="post" id="delete"<?php echo $task['id']; ?>">
    
      <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
      <button type="submit">Supprimer</button>

    </form>
    <script src="delete.js"></script>

  </td>
</tr>

                

			<?php } ?>
		</tbody>
	</table>
	<?php } else { ?>
		<p>Aucune tâche terminée n'a été trouvée.</p>
	<?php } ?>

</body>
</html>




