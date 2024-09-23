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

    <?php
        include("../../controlador/conectarBD.php");
        $mensaje = '';

        $username = isset($_POST['username']) ? $_POST['username'] : "";
        $password = isset($_POST['password']) ? $_POST['password'] : "";
        $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : "";

        $submit = isset($_POST['submit']) ? $_POST['submit'] : "";

        function validarContraseña($password) {
            // Comprobar los requisitos de la contraseña
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
            return true; // Si pasa todas las validaciones
        }

        if ($submit == 'Actualizar') {
            if (empty($username) && empty($password)) {
                $mensaje = "No se han realizado cambios.";
            } else {
                $updates = [];
                $params = [];

                if (!empty($username)) {
                    $updates[] = "username = :username";
                    $params[':username'] = $username;
                }

                if (!empty($password)) {
                    if ($password !== $confirm_password) {
                        $mensaje = "Las contraseñas no coinciden.";
                    } else {
                        $validacion = validarContraseña($password);
                        if ($validacion !== true) {
                            $mensaje = $validacion; // Si hay un error, asigna el mensaje
                        } else {
                            $updates[] = "password = :password";
                            $params[':password'] = password_hash($password, PASSWORD_BCRYPT); // Hashear la contraseña
                        }
                    }
                }

                if (!empty($updates)) {
                    $sql = "UPDATE usuarios SET " . implode(", ", $updates) . " WHERE username = :current_username";
                    $params[':current_username'] = $_POST['current_username'];

                    $statement = $conn->prepare($sql);
                    if ($statement->execute($params)) {
                        $mensaje = "Cambio de seguridad con éxito!";
                    } else {
                        $mensaje = "Error al actualizar.";
                    }
                }
            }
        }
    ?>

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
                            <input type="hidden" name="current_username" value="<?php echo htmlspecialchars($username); ?>">
                            <div class="form-row">
                                <div class="col-md-auto mb-3">
                                    <label for="username">Nuevo Usuario</label>
                                    <input type="text" class="form-control" id="username" name="username">
                                </div>
                                <div class="col-md-auto mb-3">
                                    <label for="password">Contraseña</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="password">
                                        <span class="toggle-password" onclick="togglePassword('password')">
                                            👁️
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-auto mb-3">
                                    <label for="confirm_password">Confirmar Contraseña</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                                        <span class="toggle-password" onclick="togglePassword('confirm_password')">
                                            👁️
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit" name="submit" value="Actualizar">Actualizar</button>
                            <p style="display:inline-block; text-align: right; margin-left:15px;">
                                <a href="../MenuPrincipal.php">Volver</a>
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
            if (input.type === "password") {
                input.type = "text";
            } else {
                input.type = "password";
            }
        }
    </script>
</body>
</html>
