<?php
include("../../controlador/conectarBD.php");
include("../../controlador/sesion.php");
$xpathNav = ".";
$xpathSess = "./..";

$INFsql = "SELECT * FROM usuarios, perfiles WHERE usuarios.username = '$sesionid' AND perfiles.user_perfil = '$sesionid'";
$stmnForm = $conn->prepare($INFsql); //$statementForm acortado
$stmnForm->execute();
$lista = $stmnForm->fetch(PDO::FETCH_LAZY);

//Variables que leen la información de las tablas para ponerlo en los formularios
$txNom = $lista['p_nombre'];
$txApd = $lista['p_apellido'];
$txNick = $lista['p_apodo'];
$inEdd = $lista['p_edad'];
$txMail = $lista['email'];
$inTel = $lista['p_telefono'];
$txComp = $lista['p_compañia'];

//Variables que leen la informacion de los campos del formulario para luego ser usados en la actualización
$updNom = (isset($_POST['usrnom'])) ? $_POST['usrnom'] : "";
$updApd = (isset($_POST['usrapd'])) ? $_POST['usrapd'] : "";
$updNick = (isset($_POST['usrnick'])) ? $_POST['usrnick'] : "";
$updEdd = (isset($_POST['usredd'])) ? $_POST['usredd'] : "";
$updMail = (isset($_POST['email'])) ? $_POST['email'] : "";
$updTel = (isset($_POST['usrtel'])) ? $_POST['usrtel'] : "";
$updComp = (isset($_POST['usrcomp'])) ? $_POST['usrcomp'] : "";

$submit = (isset($_POST['submit'])) ? $_POST['submit'] : "";

if ($submit == 'Guardar') {


    $UPDsql =   "UPDATE usuarios u, perfiles p
                SET u.email=:email, p.p_nombre=:nombre, p.p_apellido=:apellido, p.p_apodo=:nick, p.p_compañia=:comp, p.p_telefono=:telefono, p.p_edad=:edad
                WHERE u.username = '$sesionid' AND p.user_perfil = u.username;";

    $stmnUpdate = $conn->prepare($UPDsql);
    $stmnUpdate->bindParam(':email', $updMail);
    $stmnUpdate->bindParam(':nombre', $updNom);
    $stmnUpdate->bindParam(':apellido', $updApd);
    $stmnUpdate->bindParam(':nick', $updNick);
    $stmnUpdate->bindParam(':comp', $updComp);
    $stmnUpdate->bindParam(':telefono', $updTel);
    $stmnUpdate->bindParam(':edad', $updEdd);
    if ($stmnUpdate->execute()) {
        header("Location: ../perfil.php?msj=1");
    }
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <title>Cambiar informacion personal</title>
</head>

<body>
    <?php
    include("../../plantillas/navbar_actuser.php")
    ?>

    <div class="container" style="margin-top: 20px;">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        Editar información personal
                    </div>
                    <div class="card-body" style="margin-left: 25px; margin-right: 5%;">
                        <form class="needs-validation" method="post" novalidate>
                            <div class="form-row">
                                <div class="col-md-auto mb-3">
                                    <label for="usrnom">Nombre</label>
                                    <input type="text" class="form-control" id="usrnom" name="usrnom" value="<?php echo $txNom ?>" required>
                                    <div class="invalid-feedback">
                                        Este campo no puede estar vacio.
                                    </div>
                                </div>
                                <div class="col-md-auto mb-3">
                                    <label for="usrapd">Apellido</label>
                                    <input type="text" class="form-control" id="usrapd" name="usrapd" value="<?php echo $txApd ?>" required>
                                    <div class="invalid-feedback">
                                        Este campo no puede estar vacio.
                                    </div>
                                </div>
                                <div class="col-md-auto mb-3">
                                    <label for="usrnick">Apodo</label>
                                    <input type="text" class="form-control" id="usrnick" name="usrnick" value="<?php echo $txNick ?>">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="usredd">Edad</label>
                                    <input type="number" min="0" max="100" class="form-control" id="usredd" name="usredd" value="<?php echo $inEdd ?>">
                                </div>
                            </div>
                            <hr>
                            <div class="form-row">
                                <div class="col-md-auto mb-3">
                                    <label for="email">Email</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        </div>
                                        <input type="text" class="form-control" id="email" name="email"
                                            aria-describedby="inputGroupPrepend" value="<?php echo $txMail ?>" required>
                                        <div class="invalid-feedback">
                                            Email no valido.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="usrtel">Número celular</label>
                                    <input type="number" class="form-control" id="usrtel" name="usrtel" value="<?php echo $inTel ?>">
                                </div>
                                <div class="col-md-auto mb-3">
                                    <label for="usrcomp">Compañia</label>
                                    <input type="text" class="form-control" id="usrcomp" name="usrcomp" value="<?php echo $txComp ?>">
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit" name="submit" value="Guardar">Guardar cambios</button>
                        </form>
                        <script>
                            // Example starter JavaScript for disabling form submissions if there are invalid fields
                            (function() {
                                'use strict';
                                window.addEventListener('load', function() {
                                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                    var forms = document.getElementsByClassName('needs-validation');
                                    // Loop over them and prevent submission
                                    var validation = Array.prototype.filter.call(forms, function(form) {
                                        form.addEventListener('submit', function(event) {
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
                </div>
            </div>
        </div>
    </div>


</body>

</html>