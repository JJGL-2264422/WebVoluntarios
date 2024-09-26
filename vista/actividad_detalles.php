<?php
include("../controlador/conectarBD.php");
include("../controlador/sesion.php");
$actvID = $_GET['actcod'];
$fechaRegistro = date('Y-m-d H:i:s');


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['desactivar'])) {
  $sql = "UPDATE actividades SET ac_activo = 0 WHERE act_codigo = :act_codigo";
  $statement = $conn->prepare($sql);
  $statement->bindParam(':act_codigo', $actvID);
  if ($statement->execute()) {
    header("Location: menu_actividades.php");
    exit();
  }
}

// Verificar si ya esta registrado
$checkSql = "SELECT reg_activo FROM registros WHERE usuario_id = :usuario_id AND codigo_actividad = :codigo_actividad";
$checkStatement = $conn->prepare($checkSql);
$checkStatement->bindParam(':usuario_id', $sesionid);
$checkStatement->bindParam(':codigo_actividad', $actvID);
$checkStatement->execute();
$existingRecord = $checkStatement->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['inscribirse'])) {
  if ($existingRecord) {
    if ($existingRecord['reg_activo'] == 0) {
      $updateSql = "UPDATE registros SET reg_activo = 1 WHERE usuario_id = :usuario_id AND codigo_actividad = :codigo_actividad";
      $updateStatement = $conn->prepare($updateSql);
      $updateStatement->bindParam(':usuario_id', $sesionid);
      $updateStatement->bindParam(':codigo_actividad', $actvID);
      $updateStatement->execute();
    }
  } else {
    $insertSql = "INSERT INTO registros (usuario_id, codigo_actividad, fecha_registro, reg_activo) VALUES (:usuario_id, :codigo_actividad, :fecha_registro, :reg_activo)";
    $insertStatement = $conn->prepare($insertSql);
    $regActivo = 1;
    $insertStatement->bindParam(':usuario_id', $sesionid);
    $insertStatement->bindParam(':codigo_actividad', $actvID);
    $insertStatement->bindParam(':fecha_registro', $fechaRegistro);
    $insertStatement->bindParam(':reg_activo', $regActivo);
    $insertStatement->execute();
  }
  header("Location: actividad_detalles.php?actcod=$actvID");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['desinscribirse'])) {
  $updateSql = "UPDATE registros SET reg_activo = 0 WHERE usuario_id = :usuario_id AND codigo_actividad = :codigo_actividad";
  $updateStatement = $conn->prepare($updateSql);
  $updateStatement->bindParam(':usuario_id', $sesionid);
  $updateStatement->bindParam(':codigo_actividad', $actvID);
  $updateStatement->execute();

  header("Location: actividad_detalles.php?actcod=$actvID");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cerrar'])) {
  header("Location: menu_actividades.php");
}

// Obtener el rol del usuario
$rolSql = "SELECT rol FROM usuarios WHERE username = :username";
$rolStatement = $conn->prepare($rolSql);
$rolStatement->execute([':username' => $sesionid]);
$rol = $rolStatement->fetchColumn();

// Obtener detalles de la actividad
$sql = "SELECT * FROM actividades WHERE act_codigo = :act_codigo";
$statement = $conn->prepare($sql);
$statement->bindParam(':act_codigo', $actvID);
if ($statement->execute()) {
  $lista = $statement->fetch(PDO::FETCH_LAZY);
  $txNom = $lista['nombre'];
  $txDesc = $lista['descripcion'];
  $banner = $lista['act_img'];
  $txCreador = $lista['creador_id'];
  $txInicio = $lista['inicia_en'];
  $txCierra = $lista['termina_en'];
  $txUbicacion = $lista['ubicacion'];
}

// Obtener usuarios inscritos
$inscritosSql = "SELECT usu.username, usu.valoracion FROM registros reg JOIN usuarios usu ON reg.usuario_id = usu.username WHERE reg.codigo_actividad = :codigo_actividad AND reg.reg_activo = 1";
$inscritosStatement = $conn->prepare($inscritosSql);
$inscritosStatement->bindParam(':codigo_actividad', $actvID);
$inscritosStatement->execute();
$inscritos = $inscritosStatement->fetchAll(PDO::FETCH_ASSOC);
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

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .card {
      height: 100%;
    }

    .inscritos-card {
      padding: 15px;
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

  <div class="container" style="margin-top:2%;margin-bottom:2%">
    <div class="main">
      <div class="row d-flex">
        <div class="col-md-8 mt-1">
          <div class="card mb-3 content" style="padding:10px;">
            <div class="header">
              <h3 style="margin:10px;"><?php echo "$txNom" ?></h3>
              <!-- Boton desactivar actividad -->
              <?php if ($txCreador == $sesionid): ?>
                <form method="POST" action="">
                  <button type="submit" name="desactivar" class="btn btn-danger">Desactivar actividad</button>
                </form>
              <?php endif; ?>
            </div>
            <div style="margin:10px">
              <img src="<?php echo $banner ?>" style="border-radius:10px;display:block; margin-left:auto; margin-right:auto; width:100%;">
            </div>

            <div class="card-body">
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

                <?php if ($rol == "voluntario"): ?>
                  <?php if ($existingRecord && $existingRecord['reg_activo'] == 1): ?>
                    <!-- Boton desinscribirse -->
                    <form method="POST" action="">
                      <button type="submit" name="desinscribirse" class="btn btn-danger m-3">Desinscribirse</button>
                    </form>
                  <?php else: ?>
                    <!-- Boton inscribirse -->
                    <form method="POST" action="">
                      <button type="submit" name="inscribirse" class="btn btn-primary m-3">Inscribirse</button>
                    </form>
                  <?php endif; ?>
                <?php endif; ?>
                <!-- Boton Cerrar -->
                <form method="POST" action="">
                  <button type="submit" name="cerrar" class="btn btn-secondary m-3">Volver</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- Inscritos -->
        <div class="col-md-4" style="height:auto;align-items:start">
          <div class="card bg-secondary h-100 inscritos-card">
            <div class="card" style="padding:15px;">
              <h5>Inscritos</h5>
              <p>Aquí puedes listar a los inscritos a la actividad.</p>
              <ul style="padding-left: 15px;">
                <?php if ($inscritos): ?>
                  <?php foreach ($inscritos as $inscrito): ?>
                    <li>
                      <?php echo htmlspecialchars($inscrito['username']); ?> --
                      <?php
                      //Estrellas
                      $valoracion = $inscrito['valoracion'];
                      for ($x = 1; $x <= 5; $x++) {
                        if ($valoracion < $x) {
                          if (is_float($valoracion) && (round($valoracion) == $x)) { //Si la aproximación es igual a $x, se crea una media estrella.
                            echo '<span class="fa fa-star-half-o"></span>';
                          } else {
                            echo '<span class="fa fa-star-o"></span>';
                          }
                        } else {
                          echo '<span class="fa fa-star"></span>';
                        }
                      }
                      ?>
                    </li>
                  <?php endforeach; ?>
                <?php else: ?>
                  <li>No hay inscritos activos.</li>
                <?php endif; ?>
              </ul>
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