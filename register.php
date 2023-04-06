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
    <title>inscription</title>
</head>
<body>
<?php include('header.php') ?>
<h1>inscription</h1>
<main>
<form id="mon-formulaire-register" method="POST">
  <label for="username">Login :</label>
  <input type="text" id="username" name="username" required>

  <label for="password">Mot de passe :</label>
  <input type="password" id="password" name="password" required>

  <button type="submit">S'inscrire</button>
</form>
</main>



<script src="./register.js">


</script>


<?php include('footer.php') ?>

</body>
</html>