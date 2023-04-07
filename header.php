
<header>
        <nav>
            <ul>
                <li><a href="index.php">accueil</a></li>
                <?php if (isset($_SESSION['username'])): ?>
                    <li><a href="test.php">todo list</a></li>
                <li><a href="logout.php">Deconnexion</a></li>

                <?php else:?>
                    <li><a href="register.php">S'inscire</a></li>
                <li><a href="login.php">login</a></li>


                <?php endif; ?>
            </ul>
        </nav>
    </header>