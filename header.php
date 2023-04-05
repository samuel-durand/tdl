<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">accueil</a></li>
                <?php if (isset($_SERVER['username'])): ?>
                <li><a href="register.php">S'inscire</a></li>
                <li><a href="login.php">login</a></li>
                <?php else:?>
                <li><a href="todo list.php">todo list</a></li>
                <li><a href="logout.php">Deconnion</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
</body>
</html>