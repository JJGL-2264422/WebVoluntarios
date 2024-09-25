<?php 
include("../controlador/conectarBD.php");
$sesionid = "Voluntario123";
$mensaje = "";

// Guardar etiquetas
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['guardar']) && isset($_POST['etiquetas'])) {
    $etiquetas = array_map(function($etiqueta) {
        return ucfirst(strtolower($etiqueta)); // Primera letra en mayúscula
    }, $_POST['etiquetas']);
    $etiquetasTexto = implode(", ", $etiquetas); // Combina las etiquetas en un solo string
    $sql = "UPDATE perfiles SET etiquetas = :etiquetas WHERE user_perfil = :user_perfil";
    $statement = $conn->prepare($sql);
    $statement->execute(['etiquetas' => $etiquetasTexto, 'user_perfil' => $sesionid]);
    header("Location: " . $_SERVER['PHP_SELF']); // Recarga la pagina despues de guardar etiquetas
    exit();
}

// Quitar etiquetas
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['quitar'])) {
  $sql = "UPDATE perfiles SET etiquetas = NULL WHERE user_perfil = :user_perfil";
  $statement = $conn->prepare($sql);
  $statement->execute(['user_perfil' => $sesionid]);
  header("Location: " . $_SERVER['PHP_SELF']); // Recarga la pagina despues de quitar etiquetas
  exit();
}


if(isset($_GET['msj']) && $_GET['msj'] == 1){
  $mensaje = "Cambios guardados.";
}

$sql = "SELECT * FROM usuarios, perfiles WHERE usuarios.username = '$sesionid' AND perfiles.user_perfil = '$sesionid'";
$statement = $conn->prepare($sql);
if($statement->execute()){
  $lista=$statement->fetch(PDO::FETCH_LAZY);
  $txUser=$lista['username']; // Inicio campos de la tabla Usuarios
  $txMail=$lista['email'];
  $valoracion=$lista['valoracion'];
  $num_val=$lista['num_valor']; // Fin de campos de la tabla Usuarios
  $avatar=$lista['p_avatar']; // Inicio de campos de la tabla Perfiles
  $txNom=$lista['p_nombre'];
  $txApe=$lista['p_apellido'];
  $txComp=$lista['p_compañia'];
  $txApodo=$lista['p_apodo'];
  $inTel=$lista['p_telefono'];
  $inEdad=$lista['p_edad'];
  $etiquetas = $lista['etiquetas'];
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .etiqueta {
            display: inline-block;
            padding: 7px;
            margin: 5px;
            background-color: #b3d4fc;
            border: 1px solid #99c2ff;
            border-radius: 5px;
            font-size: 1.1em;
            color: black;
        }
    </style>
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
                    <div class="justify-content-between align-items-center" style="margin-top:40px;">
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
                        
                        echo '<span style="font-size: 10px; margin-left: 5px">(' . $num_val . ') </span>'; // Numero de valoraciones
                        ?>
                      </p>
                      <p style="margin-top: -15px;"><?php echo $valoracion ?></p>
                      <!--Espacio para más datos-->
                    </div>
                  </div>
                </div>
              </div>

                <div class="col-md-8 mt-1">
                    <div class="card mb-3 content"  style="padding:10px;">
                        <div class="d-flex justify-content-between align-items-center">
                            <h1 class="m-3 pt-2">Datos personales</h1>
                            <!-- Botón "Cambiar usuario y contraseña" -->
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

                      <!-- Etiquetas -->
                      <div class="card mb-3 content">
                          <div class="card-body">
                              <div class="d-flex justify-content-between align-items-center">
                                <h1 class="primary m-3">Aptitudes</h1>
                                <!-- Botón "Agregar etiquetas" -->
                                <button type="button" class="btn btn-primary m-3" data-toggle="modal" data-target="#etiquetasModal">Agregar etiquetas</button>
                              </div>
                              <div class="row">
                                  <div class="col-md-12 text-light">
                                      <?php 
                                      if (!empty($etiquetas)) {
                                          $listaEtiquetas = explode(", ", $etiquetas);
                                          foreach ($listaEtiquetas as $etiqueta) {
                                              echo "<span class='etiqueta'>" . $etiqueta . "</span>"; // Muestra cada etiqueta por separado
                                          }
                                      } else {
                                          echo "<p>No hay etiquetas disponibles.</p>";
                                      }
                                      ?>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- Añade el modal para las etiquetas -->
                      <?php include("../plantillas/perfil_tags.php"); ?>

                </div>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>