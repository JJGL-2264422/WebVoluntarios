<?php
include("../controlador/conectarBD.php");
include("../controlador/sesion.php");
$xpathNav = "";
$xpathSess = ".";

$SELsql = "SELECT * FROM actividades WHERE ac_activo = 1";
$statement = $conn->prepare($SELsql);
$statement->execute();
$listaActs = $statement->fetchAll(PDO::FETCH_ASSOC);

// Obtener el rol del usuario
$rolSql = "SELECT rol FROM usuarios WHERE username = :username";
$rolStatement = $conn->prepare($rolSql);
$rolStatement->execute([':username' => $sesionid]);
$rol = $rolStatement->fetchColumn();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $fechaInicio = $_POST['fechaInicio'];
    $fechaCierre = $_POST['fechaCierre'];
    $ubicacion = $_POST['ubicacion'];

    $insertSql = "INSERT INTO actividades (nombre, descripcion, creador_id, act_rol, inicia_en, termina_en, ubicacion) 
                  VALUES (:nombre, :descripcion, :creador_id, :act_rol, :inicia_en, :termina_en, :ubicacion)";

    $insertStatement = $conn->prepare($insertSql);
    $insertStatement->execute([
        ':nombre' => $nombre,
        ':descripcion' => $descripcion,
        ':creador_id' => $sesionid,
        ':act_rol' => $rol,
        ':inicia_en' => $fechaInicio,
        ':termina_en' => $fechaCierre,
        ':ubicacion' => $ubicacion,
    ]);

    // Recargar después de guardar
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en" style="overflow-x: hidden; width:100%;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Actividades</title>
</head>

<body>

    <?php
    include("../plantillas/navbar_actuser.php")
    ?>

    <div class="content-wrapper container-fluid p-0">
        <div class="row no-gutters" style="min-height: 100vh;">
            <div class="order-1 col-2 sidebar d-flex flex-column bg-secondary" style="max-width: 300px;">
                <div class="card" style="min-height: calc(100% - 20px); margin-left:10px; margin-top:10px; margin-bottom:10px;">
                    <div style="margin:15px;">
                        <!-- Boton para abrir el modal -->
                        <button type="button" class="btn btn-secondary w-100" data-bs-toggle="modal" data-bs-target="#crearActividadModal">
                            Crear actividad
                        </button>
                    </div>
                    <hr>
                </div>
            </div>
            <div class="order-2 col-lg-auto container" style="max-width:80%;margin:15px;">
                <!-- Crear uno por actividad -->
                <div style="margin-left:15px;margin-top:10px;display:flex; justify-content:start; flex-wrap:wrap;">
                    <?php
                    foreach ($listaActs as $actvs) {
                        echo ('<div style="margin-right:5px;margin-bottom:5px;">
                                    <div class="card" style="width: 18rem; height:285px;">
                                        <div style="max-height:125px;width:auto;overflow:hidden;margin-left:15px;margin-right:15px;margin-top:15px;">
                                        <img src="' . $actvs['act_img'] . '" style="border-radius:5px;display:block; margin-left:auto; margin-right:auto; width:100%;">
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title text-truncate" style="overflow:hidden;text-overflow:ellipsis;">' . $actvs['nombre'] . '</h5>
                                            <p class="card-text">' . $actvs['ubicacion'] . '</p>
                                            <a href="./actividad_detalles.php?actcod=' . $actvs['act_codigo'] . '" class="btn btn-primary">Ver detalles</a>
                                        </div>
                                    </div>
                                </div>');
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para crear actividad -->
    <div class="modal fade" id="crearActividadModal" tabindex="-1" aria-labelledby="crearActividadLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crearActividadLabel">Crear Actividad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="fechaInicio" class="form-label">Fecha de Inicio</label>
                            <input type="datetime-local" class="form-control" id="fechaInicio" name="fechaInicio" required>
                        </div>
                        <div class="mb-3">
                            <label for="fechaCierre" class="form-label">Fecha de Cierre</label>
                            <input type="datetime-local" class="form-control" id="fechaCierre" name="fechaCierre" required>
                        </div>
                        <div class="mb-3">
                            <label for="ubicacion" class="form-label">Ubicación</label>
                            <input type="text" class="form-control" id="ubicacion" name="ubicacion" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Crear Actividad</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
<footer class="bg-secondary">
    <div style="margin-top: 15px;">
        .
    </div>
</footer>

</html>