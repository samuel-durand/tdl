
<footer>
    <ul>
        <li><a href="index.php">accueil</a></li>
        <li><a href="register.php">S'inscrire</a></li>
        <li><a href="login.php">login</a></li>
        <li><a href="todo list.php">todo list</a></li>
    </ul>
</footer>

<script>
  const footer = document.querySelector('footer');

  function fixFooter() {
    const windowHeight = window.innerHeight;
    const bodyHeight = document.body.offsetHeight;
    const footerHeight = footer.offsetHeight;

    if (windowHeight > bodyHeight + footerHeight) {
      footer.style.position = 'fixed';
      footer.style.bottom = '0';
    } else {
      footer.style.position = 'relative';
    }
  }

  fixFooter();

  window.addEventListener('resize', fixFooter);
</script>
