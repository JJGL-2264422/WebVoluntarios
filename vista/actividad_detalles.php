<?php
include("../controlador/conectarBD.php");
$actvID = $_GET['actcod'];

$sql = "SELECT * FROM actividades WHERE act_codigo = '$actvID'";
$statement = $conn->prepare($sql);
if ($statement->execute()) {
  $lista = $statement->fetch(PDO::FETCH_LAZY);
  $txNom = $lista['nombre']; // Inicio campos de la tabla Usuarios
  $txDesc = $lista['descripcion'];
  $banner = $lista['act_img'];
  $txCreador = $lista['creador_id']; // Fin de campos de la tabla Usuarios
  $txInicio = $lista['inicia_en']; // Inicio de campos de la tabla Perfiles
  $txCierra = $lista['termina_en'];
  $txUbicacion = $lista['ubicacion'];
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
  <title><?php echo $txNom ?></title>
</head>

<body>
  <nav class="navbar navbar-expand navbar-light bg-body-tertiary">
    <div class="container-fluid">
      <div class="nav navbar-nav">
        <a class="navbar-brand" href="MenuPrincipal.php">Voluntarios S.A</a>
        <a class="nav-item nav-link" href="./perfil.php">Perfil</a>
        <a class="nav-item nav-link" href="./menu_actividades.php">Actividades</a>
      </div>
      <div class="nav navbar-nav">
        <a class="nav-item nav-link" href="#">Cerrar sesión</a>
      </div>
    </div>
  </nav>

  <div class="container" style="margin-top:2%">
    <div class="main">
      <div class="row">
        <div class="col-md-8 mt-1">
          <div class="card mb-3 content" style="padding:10px;">
            <h3 style="margin:10px;"><?php echo "$txNom" ?></h3>
            <div style="margin:10px">
              <img src="<?php echo $banner ?>" style="border-radius:10px;display:block; margin-left:auto; margin-right:auto; width:100%;">
            </div>
            <!--Filas de info-->
            <div class="card-body"> <!--Un row por cada campo de información-->

              <div style="margin-bottom:6px;margin-top:-7px">
                <p style="font-weight:bold; font-size:large; margin-bottom:2px;">Descripción:</p>
                <div class="card bg-secondary" style="margin-left:-3px;padding:8px;">
                  <?php echo $txDesc ?>
                </div>
              </div>

              <div>
                <span style="font-weight:bold; font-size:large">Fecha: </span>
                <span class="text-muted"><?php echo $txInicio ?></span>
                <span style="font-weight:bold; font-size:large;margin-left:40px">Ubicacion: </span>
                <span class="text-muted"><?php echo $txUbicacion ?></span>
              </div>

              <div class="d-flex justify-content-end align-items-end" style="margin-bottom:-20px">
                <p style="font-size:medium; margin-right:5px">Cierra el</p>
                <p class="text-muted"><?php echo $txCierra ?></p>
                <a href="./formularios/cambio_seguridad.php" class="btn btn-primary m-3">Inscribirse</a>
              </div>

            </div>
          </div>

        </div>

      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
</body>

</html>