<?php 

include('config.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>connexion</title>

</head>
<body>
    <h1>Connexion</h1>
    <main>
    <form method="post" id="mon-formulaire">
        <label for="username">Login:</label>
        <input type="text" name="username" id="username">

        <label for="password">Password:</label>
        <input type="password" name="password" id="password">

        <button type="submit">se connecter</button>
</form>
</main>
<script src="./login.js"></script>




</body>
</html>