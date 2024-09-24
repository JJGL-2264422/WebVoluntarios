<?php 
include("../controlador/conectarBD.php");
$sesionid = "Voluntario123";
$mensaje = "";

if(isset($_GET['msj']) && $_GET['msj'] == 1){
  $mensaje = "Cambios guardados.";
}
$sql = "SELECT * FROM usuarios, perfiles WHERE usuarios.username = '$sesionid' AND perfiles.user_perfil = '$sesionid'";
$statement = $conn->prepare($sql);
if($statement->execute()){
  $lista=$statement->fetch(PDO::FETCH_LAZY);
  $txUser=$lista['username']; //Inicio campos de la tabla Usuarios
  $txMail=$lista['email'];
  $valoracion=$lista['valoracion'];
  $num_val=$lista['num_valor']; //Fin de campos de la tabla Usuarios
  $avatar=$lista['p_avatar']; //Inicio de campos de la tabla Perfiles
  $txNom=$lista['p_nombre'];
  $txApe=$lista['p_apellido'];
  $txComp=$lista['p_compañia'];
  $txApodo=$lista['p_apodo'];
  $inTel=$lista['p_telefono'];
  $inEdad=$lista['p_edad'];
}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title><?php echo $txUser ?></title>
</head>
<body>
    <nav class="navbar navbar-expand navbar-light bg-light justify-content-between">
        <div class="nav navbar-nav">
          <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
          <a class="nav-item nav-link" href="#">Actividades</a>
        </div>
        <div class="nav navbar-nav">
          <a class="nav-item nav-link" href="#">Cerrar sesión</a>
        </div>
    </nav>

    <div class="container" style="margin-top:2%">
        <?php 
          if(!empty($mensaje)){
            echo '<div class ="alert alert-info">' . $mensaje . '</div>';
          }
        ?>
        <div class="main">
            <div class="row">

            <!--Card de la imagen y nombre de usuario-->
              <div class="col-md-4 mt-1">
                <div class="card text-center sidebar">
                  <div class="col-12 card bg-faded mt-2" style="overflow:hidden;">
                    <div style="height:125px; background-color:#5c5b5b"></div>
                    <a class="bg-faded p-1 rounded-circle ml-3" style="height:100px; margin-top: -80px">
                      <img src="<?php echo $avatar;?>" class="rounded-circle" style="height:125px; width:125px; border: 7px solid #303030; background-color:#303030" width="150">
                    </a>
                    <div class="justify-content-between align-items-center" style="margin-top:40px;" >
                      <a href="./formularios/cambio_perinfo.php" class="btn btn-primary">Editar datos personales</a>
                    </div>
                    <div class="mt-3">
                      <h3><?php echo $txUser ?></h3>

                      <?php if($inEdad != 0){
                        echo ("<p>$inEdad años</p>");
                      }

                      ?>
                      <p>
                        <?php //Función que pone el rating de estrellas
                        for($x = 1; $x <= 5; $x++){
                          if($valoracion < $x ) {
                            if(is_float($valoracion) && (round($valoracion) == $x)){ //Si la aproximación es igual a $x, se crea una media estrella.
                              echo '<span class="fa fa-star-half-o"></span>';
                            }else{
                              echo '<span class="fa fa-star-o"></span>';
                            }
                         }else {
                          echo '<span class="fa fa-star"></span>';
                         }
                        }
                        
                        echo '<span style="font-size: 10px; margin-left: 5px">(' . $num_val . ') </span>'; //Numero de valoraciones
                        ?>
                      </p>
                      <p style="margin-top: -15px;"><?php echo $valoracion ?></p>
                      <!--Espacio para más datos-->
                    </div>
                  </div>
                </div>
              </div>

                <div class="col-md-8 mt-1">
                    <div class="card mb-3 content">
                        <div class="d-flex justify-content-between align-items-center">
                            <h1 class="m-3 pt-3">Datos personales</h1>
                            <a href="./formularios/cambio_seguridad.php" class="btn btn-primary m-3">Cambiar usuario y contraseña</a>
                        </div>
                        <!--Filas de info-->
                        <div class="card-body"> <!--Un row por cada campo de información-->
                            <div class="row"> 
                                <div class="col-md-3">
                                    <h5>Nombre completo</h5>
                                </div>
                                <div class="col-md-9 text-light">
                                    <?php echo "$txNom $txApe" ?>
                                </div>
                            </div><hr>
                            <?php //Bloque de codigo que muestra u oculta las filas de los campos opcional basado en si tienen datos o no.
                            
                            if(!empty($txApodo)){ 
                              echo ('
                              <div class="row"> 
                                <div class="col-md-3">
                                  <h5>Apodo: </h5>
                                </div>
                                <div class="col-md-9 text-light">' . $txApodo . '</div>
                              </div><hr>');
                            }

                            if(!empty($txComp)){ 
                              echo ('
                              <div class="row"> 
                                <div class="col-md-3">
                                  <h5>Trabaja en: </h5>
                                </div>
                                <div class="col-md-9 text-light">' . $txComp . '</div>
                              </div><hr>');
                            }
                            
                            if($inTel != 0){ 
                              echo ('
                              <div class="row"> 
                                <div class="col-md-3">
                                  <h5>Numero celular: </h5>
                                </div>
                                <div class="col-md-9 text-light">' . $inTel . '</div>
                              </div><hr>');
                            }

                            ?>

                            <div class="row"> 
                                <div class="col-md-3">
                                    <h5>Correo Electronico</h5>
                                </div>
                                <div class="col-md-9 text-light">
                                    <?php echo $txMail; ?>
                                </div>
                            </div><hr>

                          </div>
                      </div>

                    <!-- <div class="card mb-3 content">
                        <h1 class="m-3 pt-3">Registros</h1>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>-Proximamente-</h5>
                                </div>
                                <div class="col-md-9 text-light">
                                    -
                                </div>
                            </div><hr>
                        </div>
                    </div> -->

                </div>

            </div>
        </div>
    </div>

</body>
</html>