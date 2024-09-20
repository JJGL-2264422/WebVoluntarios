<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Registrarse</title>
        <link rel="stylesheet" href="../../css/bootstrap.min.css">
    </head>
    <body>
        
        <?php
            include("../../controlador/conectarBD.php");
            $mensaje = '';

            $username = isset($_POST['username']) ? $_POST['username'] : "";
            $password = isset($_POST['password']) ? $_POST['password'] : "";
            $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : "";
            
            $submit = isset($_POST['submit']) ? $_POST['submit'] : "";

            if ($submit == 'Registro') {
                if ($password === $confirm_password) {
                    $sql = "INSERT INTO public.usuarios(username, password) VALUES (:username, :password)";
                    $statement = $conn->prepare($sql);
                    if ($statement->execute([':username' => $username, ':password' => $password])) {
                        $mensaje = "Registro con éxito!";
                    } else {
                        $mensaje = "Error al registrar.";
                    }
                } else {
                    $mensaje = "Las contraseñas no coinciden.";
                }
            }
        ?>

        <div class="container" style="margin-top: 20px;">
            <div class="row justify-content-center">

                <?php if (!empty($mensaje)): ?>
                    <div class="alert alert-info"> <?= $mensaje; ?> </div>
                <?php endif; ?>

                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">Registrarse</div>
                        <div class="card-body" style="margin-left: 25px; margin-right: 5%;">
                            <form class="needs-validation" method="post" novalidate>
                                <div class="form-row">
                                    <div class="col-md-auto mb-3">
                                        <label for="username">Nuevo usuario</label>
                                        <input type="text" class="form-control" id="username" name="username" required>
                                    </div>
                                    <div class="col-md-auto mb-3">
                                        <label for="password">Contraseña</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                    <div class="col-md-auto mb-3">
                                        <label for="confirm_password">Confirmar contraseña</label>
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit" name="submit" value="Registro">Registrarse</button>
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
            (function () {
                'use strict'; 
                window.addEventListener('load', function () {
                    var forms = document.getElementsByClassName('needs-validation');
                    var validation = Array.prototype.filter.call(forms, function (form) {
                        form.addEventListener('submit', function (event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add('was-validated');
                        }, false);
                    });
                }, false);
            })();
        </script>
    </body>
</html>