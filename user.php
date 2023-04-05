<?php


include('config.php');


if (date("H") < 18)
$bienvenue = "bonjour et bienvenue " .
$_SESSION['username'];
else 
$bienvenue = "bonsoir et bienvenue " .
$_SESSION['username'];

?>