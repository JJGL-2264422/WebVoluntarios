<?php
        include("../../controlador/conectarBD.php");
        include("../../controlador/sesion.php");
        $mensaje = '';
        $userUPD = 0;


        $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : "";
        $email = $conn->query("SELECT * FROM usuarios WHERE username = '$sesionid'")->fetch()[2];
        $password = isset($_POST['password']) ? $_POST['password'] : "";
        $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : "";
        $submit = isset($_POST['submit']) ? $_POST['submit'] : "";

        function validarContraseña($password) {
            if (strlen($password) < 8) {
                return "La contraseña debe tener al menos 8 caracteres.";
            }
            if (!preg_match('/[A-Z]/', $password)) {
                return "La contraseña debe contener al menos una letra mayúscula.";
            }
            if (!preg_match('/[0-9]/', $password)) {
                return "La contraseña debe contener al menos un número.";
            }
            if (!preg_match('/[\W_]/', $password)) { 
                return "La contraseña debe contener al menos un símbolo.";
            }
            return true;
        }

        if ($submit == 'Actualizar') {
            $updates = [];
            $params = [];

            if (!empty($usuario)) {
                $updates[] = "username = :usuario";
                $params[':usuario'] = $usuario;
                $userUPD = 1;
                
            }

            if (!empty($password)) {
                if ($password !== $confirm_password) {
                    $mensaje = "Las contraseñas no coinciden.";
                } else {
                    $validacion = validarContraseña($password);
                    if ($validacion !== true) {
                        $mensaje = $validacion;
                    } else {
                        $updates[] = "password = :password";
                        $params[':password'] = $password;
                    }
                }
            }

            if (!empty($updates)) {
                $sql = "UPDATE usuarios SET " . implode(', ', $updates) . " WHERE email = :email";
                $params[':email'] = $email;
                $statement = $conn->prepare($sql);

                if ($statement->execute($params)) {
                    if($userUPD == 1) $_SESSION['usuario_activo'] = $usuario;
                    header("Location: ../perfil.php?msj=1");
                } else {
                    $mensaje = "Error al actualizar: ";
                }
            }
        }
    ?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Cambio de Seguridad</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <style>
        .input-group {
            position: relative;
            margin-bottom: 15px; 
        }
        .input-group .toggle-password {
            position: absolute;
            right: -35px; 
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: gray; 
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand navbar-light bg-body-tertiary">
        <div class="container-fluid">
            <div class="nav navbar-nav">
                <a class="navbar-brand" href="MenuPrincipal.php">Voluntarios S.A</a>
                <a class="nav-item nav-link" href="../perfil.php">Perfil></a>
                <a class="nav-item nav-link" href="./menu_actividades.php">Actividades</a>
            </div>
            <div class="nav navbar-nav">
                <a class="nav-item nav-link" href="../../controlador/cerrar_sesion.php">Cerrar sesión</a>
            </div>
        </div>
    </nav>

    <div class="container" style="margin-top: 20px;">
        <div class="row justify-content-center">

            <?php
                if (!empty($mensaje)) {
                    echo '<div class="alert alert-danger">' . $mensaje . '</div>';
                }
            ?>

            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        Cambio de Seguridad
                    </div>
                    <div class="card-body" style="margin-left: 25px; margin-right: 5%;">
                        <small class="text-muted">
                            Si no quiere cambiar su usuario o contraseña, deje el espacio en blanco.<br>
                        </small>
                        <div style="margin-top: 15px;"></div>
                        <form method="post">
                            <div class="form-row">
                                <div class="col-md-auto mb-3">
                                    <label for="usuario">Nuevo Usuario</label>
                                    <input type="text" class="form-control" id="usuario" name="usuario">
                                </div>
                                <div class="col-md-auto mb-3">
                                    <label for="password">Contraseña</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="password">
                                        <span class="toggle-password" onclick="togglePassword('password')">👁️</span>
                                    </div>
                                </div>
                                <div class="col-md-auto mb-3">
                                    <label for="confirm_password">Confirmar Contraseña</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                                        <span class="toggle-password" onclick="togglePassword('confirm_password')">👁️</span>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit" name="submit" value="Actualizar">Actualizar</button>
                            <p style="display:inline-block; text-align: right; margin-left:15px;">
                                <a href="../perfil.php">Volver</a>
                            </p>
                        </form>
                    </div>
                    <div class="card-footer text-muted"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(id) {
            var input = document.getElementById(id);
            input.type = input.type === "password" ? "text" : "password";
        }
    </script>
</body>
</html>