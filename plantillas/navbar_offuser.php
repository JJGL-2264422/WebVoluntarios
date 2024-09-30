<!-- Utilizado principalmente por MenuPrincipal.php -->
<nav class="navbar navbar-expand bg-dark ">
    <div class="container-fluid">
      <div class="nav navbar-nav">
        <a class="navbar-brand text-white"  href="./MenuPrincipal.php" >Voluntarios S.A</a>
      </div>
      <div class="nav navbar-nav">
        <a class="nav-item nav-link text-muted" <?php echo 'href=".'.$xpathNav.'/login.php"'?> >Iniciar sesión</a>
        <a style="border-left:3px solid gray;"></a>
        <a class="nav-item nav-link text-muted" <?php echo 'href=".'.$xpathNav.'/registro.php"'?> ">Registrarse</a>
      </div>
    </div>
  </nav>