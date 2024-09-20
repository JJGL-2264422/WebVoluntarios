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

            $username = (isset($_POST['username']))?$_POST['username']:"";
            $password = (isset($_POST['password']))?$_POST['password']:"";
            $nom = (isset($_POST['usrnom']))?$_POST['usrnom']:"";
            $ape = (isset($_POST['usrapd']))?$_POST['usrapd']:"";
            $email = (isset($_POST['email']))?$_POST['email']:"";
            $rol = (isset($_POST['username']))?$_POST['role']:"";
            $comp = (isset($_POST['comp']))?$_POST['comp']:"";


            $submit = (isset($_POST['submit']))?$_POST['submit']:"";
            //
            if($submit == 'Registro'){
                $submit = "";
                $sql = "insert into usuarios (username,password,email,rol) values (:username,:password,:email,:rol)";
                $statement = $conn->prepare($sql);
                if($statement->execute([':username' => $username, ':password' => $password,':email' => $email, ':rol' => $rol])){
                    $sql = "insert into perfiles (user_perfil,nombre,apellido,compañia) values (:userid,:nom,:ape,:comp)";
                    $statement = $conn->prepare($sql);
                    $statement->execute([':userid' => $username, ':nom' => $nom, ':ape' => $ape,':comp' => $comp]);
                    $mensaje = "Registro con éxito!";
                }
                else{
                    $mensaje = "Error";
                }
            }   
        ?>

        <div class="container" style="margin-top: 20px;">
            <div class="row justify-content-center">

                <?php
                    if(!empty($mensaje)){ echo '<div class="alert alert-danger">' . $mensaje . '</div>'; }
                ?>

                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            Registrarse
                        </div>
                        <div class="card-body" style="margin-left: 25px; margin-right: 5%;">
                            <form class="needs-validation" method="post" novalidate>
                            <div class="form-row">
                                <div class="col-md-auto mb-3">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>
                                <div class="col-md-auto mb-3">
                                    <label for="password">Contraseña</label>
                                    <input type="text" class="form-control" id="password" name="password" autocomplete="new-password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                                    <div class="invalid-feedback">
                                    La contraseña debe tener minimo una (1) mayuscula, un (1) número, un (1) simbolo y 8 carácteres.
                                    </div>
                                </div>
                                <form class="needs-validation" novalidate>
                                <div class="form-row">
                                    <div class="col-md-auto mb-3">
                                        <label for="usrnom">Nombre</label>
                                        <input type="text" class="form-control" id="usrnom" name="usrnom" required>
                                    </div>
                                    <div class="col-md-auto mb-3">
                                        <label for="usrapd">Apellido</label>
                                        <input type="text" class="form-control" id="usrapd" name="usrapd" required>
                                    </div>
                                    <div class="col-md-auto mb-3">
                                        <label for="email">Email</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                            </div>
                                            <input type="text" class="form-control" id="email" name="email" aria-describedby="inputGroupPrepend" required>
                                            <div class="invalid-feedback">
                                                Email no valido.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-5 mb-3">
                                    <label for="role">Tipo de Cuenta</label>
                                        <select type="text" class="form-control" id="role" name="role" placeholder="-Seleccione el tipo-" required>
                                            <option value="" selected disabled>-Seleccione el tipo-</option>
                                            <option value="manager">Manager</option>
                                            <option value="voluntario">Voluntario</option>
                                        </select>
                                        <div class="invalid-feedback">
                                        Seleccione el tipo de cuenta.
                                        </div>
                                    </div>
                                    <div class="col-md-auto mb-4">
                                        <label for="comp">Compañia</label>
                                        <input type="text" class="form-control" id="comp" name="comp">
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit" name="submit" value="Registro">Registrarse</button>
                            <p style="display:inline-block; text-align: right; margin-left:15px;">
                                <a href="../MenuPrincipal.php">Volver</a>
                            </p>
                            </form>
                            <script>
                             // Example starter JavaScript for disabling form submissions if there are invalid fields
                              (function () {
                             'use strict'; 
                            window.addEventListener('load', function () {
                                  // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                  var forms = document.getElementsByClassName('needs-validation');
                                  // Loop over them and prevent submission
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
                        </div>
                        <div class="card-footer text-muted"></div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>