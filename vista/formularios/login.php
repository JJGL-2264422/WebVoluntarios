<?php
include("../../controlador/conectarBD.php");
session_start();
$user = (isset($_POST['username'])) ? $_POST['username'] : "";
$contraseña = (isset($_POST['password'])) ? $_POST['password'] : "";
$mensaje = "";

if (isset($_GET['msj']) && $_GET['msj'] == 1) {
    $mensaje = "Su sesión ha caducado, inicie sesión nuevamente.";
}

if (isset($_GET['msj']) && $_GET['msj'] == 2) {
    $mensaje = "¡Registrado correctamente!";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "SELECT * FROM usuarios WHERE username='$user' AND password = '$contraseña'";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $lista = $statement->fetch(PDO::FETCH_LAZY);
    if (!empty($lista)) {
        $valUser = $lista['username'];
        $valPass = $lista['password'];
        $valAcvo = $lista['us_activo'];
    } else {
        $valUser = $valPass = $valAcvo = "";
    }
    if ($user == $valUser && $contraseña == $valPass) {
        if ($valAcvo == 1) {
            $_SESSION['usuario_activo'] = $user;
            header("location: ../menu_actividades.php");
        } else {
            $mensaje = "Usuario inactivo.";
        }
    } else {
        $mensaje = "Usuario o contraseña incorrectos.";
    }
}
?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
</head>

<body>
    <div class="container" style="margin-top:50px;">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <?php
                if (!empty($mensaje)) {
                    echo '<div class ="alert alert-danger">' . $mensaje . '</div>';
                }
                ?>
                <div class="card">
                    <div class="card-header">
                        <h4>Iniciar Sesión</h4>
                    </div>
                    <div class="card-body">
                        <form class="needs-validation" method="post">
                            <div class="form-group">
                                <label for="username">Nombre de Usuario</label>
                                <input type="username" class="form-control" id="username" name="username"> <br>
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password"> <br>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Recuerdame</label>
                                <p></p>
                            </div>
                            <button type="submit" class="btn btn-primary" name="enter">Entrar</button>
                        </form>
                        No tienes una cuenta? <a class="btn btn-primary" href="./registro.php" role="button">Registrarse</a>
                    </div>
                    <div class="card-footer text-muted"></div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>