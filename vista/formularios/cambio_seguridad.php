<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Cambio de Seguridad</title>
        <link rel="stylesheet" href="../../css/bootstrap.min.css">
        <style>
            .input-group {
                display: flex;
                align-items: center;
            }
            .input-group input {
                flex: 1; /* Permite que el input ocupe el espacio disponible */
            }
            .toggle-password {
                cursor: pointer;
                margin-left: 10px; /* Espacio entre el input y el ícono */
                color: black; /* Color negro para el ícono */
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
                        } elseif (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password)) {
                            $mensaje = "La contraseña debe tener al menos una mayúscula, un número, un símbolo y 8 caracteres.";
                        } else {
                            $updates[] = "password = :password";
                            $params[':password'] = $password;
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
                                            <input type="password" class="form-control" id="password" name="password" required>
                                            <span class="toggle-password" onclick="togglePassword('password')">
                                                👁️
                                            </span>
                                        </div>
                                        <small class="form-text text-muted">
                                            La contraseña debe tener al menos una mayúscula, un número, un símbolo y 8 caracteres.
                                        </small>
                                    </div>
                                    <div class="col-md-auto mb-3">
                                        <label for="confirm_password">Confirmar Contraseña</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
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