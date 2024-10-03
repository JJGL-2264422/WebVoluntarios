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
    if (isset($_POST['etiquetas'])) {
        $etiquetas = array_map(function ($etiqueta) {
            return ucfirst(strtolower($etiqueta)); // Primera letra en mayúscula
        }, $_POST['etiquetas']);
        $etiquetasTexto = implode(", ", $etiquetas);
    }else{
        $etiquetasTexto = "";
    }


    $insertSql = "INSERT INTO actividades (nombre, descripcion, creador_id, act_rol, inicia_en, termina_en, ubicacion, act_etiquetas) 
                  VALUES (:nombre, :descripcion, :creador_id, :act_rol, :inicia_en, :termina_en, :ubicacion, :etiquetas)";

    $insertStatement = $conn->prepare($insertSql);
    $insertStatement->execute([
        ':nombre' => $nombre,
        ':descripcion' => $descripcion,
        ':creador_id' => $sesionid,
        ':act_rol' => $rol,
        ':inicia_en' => $fechaInicio,
        ':termina_en' => $fechaCierre,
        ':ubicacion' => $ubicacion,
        ':etiquetas' => $etiquetasTexto,
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
        <div class="row no-gutters" style="min-height: 100vh; margin-left:10px;">
            <div class="order-1 col-2 sidebar d-flex flex-column bg-secondary" style="max-width: 300px; margin-top:12px">
                <div class="card" style="min-height: calc(100% - 20px); margin-left:2px; margin-top:10px; margin-bottom:10px;">
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
                        <label for="etiquetas[]" class="form-label">Etiquetas</label>
                        <div class="text-center" style="margin-bottom:15px;padding-bottom:7px; padding-top:7px;border:3px solid #454545">
                            <div class="form-check form-check-inline" style="margin-left:7px">
                                <input class="form-check-input" type="checkbox" name="etiquetas[]" value="Cocina" id="etiquetaCocina">
                                <label class="form-check-label" for="etiquetaCocina">Cocina</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="etiquetas[]" value="Animales domésticos" id="etiquetaAnimalesDomesticos">
                                <label class="form-check-label" for="etiquetaAnimalesDomesticos">Animales domésticos</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="etiquetas[]" value="Animales de granja" id="etiquetaAnimalesGranja">
                                <label class="form-check-label" for="etiquetaAnimalesGranja">Animales de granja</label>
                            </div>
                            <div style="margin-top:5px;margin-bottom:5px;border-top:3px solid #454545"></div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="etiquetas[]" value="Niños" id="etiquetaNinos">
                                <label class="form-check-label" for="etiquetaNinos">Niños</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="etiquetas[]" value="Atención a personas mayores" id="etiquetaAtencionMayores">
                                <label class="form-check-label" for="etiquetaAtencionMayores">Atención a personas mayores</label>
                            </div>
                            <div style="margin-top:5px;margin-bottom:5px;border-top:3px solid #454545"></div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="etiquetas[]" value="Manualidades" id="etiquetaManualidades">
                                <label class="form-check-label" for="etiquetaManualidades">Manualidades</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="etiquetas[]" value="Deportes" id="etiquetaDeportes">
                                <label class="form-check-label" for="etiquetaDeportes">Deportes</label>
                            </div>
                            <div class="form-chec form-check-inline">
                                <input class="form-check-input" type="checkbox" name="etiquetas[]" value="Enseñanza" id="etiquetaEnsenanza">
                                <label class="form-check-label" for="etiquetaEnsenanza">Enseñanza</label>
                            </div>
                            <div style="margin-top:5px;margin-bottom:5px;border-top:3px solid #454545"></div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="etiquetas[]" value="Tecnología" id="etiquetaTecnologia">
                                <label class="form-check-label" for="etiquetaTecnologia">Tecnología</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="etiquetas[]" value="Fotografía" id="etiquetaFotografia">
                                <label class="form-check-label" for="etiquetaFotografia">Fotografía</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="etiquetas[]" value="Jardinería" id="etiquetaJardineria">
                                <label class="form-check-label" for="etiquetaJardineria">Jardinería</label>
                            </div>
                            <div style="margin-top:5px;margin-bottom:5px;border-top:3px solid #454545"></div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="etiquetas[]" value="Traducción" id="etiquetaTraduccion">
                                <label class="form-check-label" for="etiquetaTraduccion">Traducción</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="etiquetas[]" value="Gestión de redes sociales" id="etiquetaGestionRedes">
                                <label class="form-check-label" for="etiquetaGestionRedes">Gestión de redes sociales</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="etiquetas[]" value="Escritura" id="etiquetaEscritura">
                                <label class="form-check-label" for="etiquetaEscritura">Escritura</label>
                            </div>
                            <div style="margin-top:5px;margin-bottom:5px;border-top:3px solid #454545"></div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="etiquetas[]" value="Informática" id="etiquetaInformatica">
                                <label class="form-check-label" for="etiquetaInformatica">Informática</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="etiquetas[]" value="Comunicación" id="etiquetaComunicacion">
                                <label class="form-check-label" for="etiquetaComunicacion">Comunicación</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="etiquetas[]" value="Contabilidad" id="etiquetaContabilidad">
                                <label class="form-check-label" for="etiquetaContabilidad">Contabilidad</label>
                            </div>
                            <div style="margin-top:5px;margin-bottom:5px;border-top:3px solid #454545"></div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="etiquetas[]" value="Salud y bienestar" id="etiquetaSaludBienestar">
                                <label class="form-check-label" for="etiquetaSaludBienestar">Salud y bienestar</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="etiquetas[]" value="Investigación" id="etiquetaInvestigacion">
                                <label class="form-check-label" for="etiquetaInvestigacion">Investigación</label>
                            </div>
                            <div style="margin-top:5px;margin-bottom:5px;border-top:3px solid #454545"></div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="etiquetas[]" value="Arte y creatividad" id="etiquetaArteCreatividad">
                                <label class="form-check-label" for="etiquetaArteCreatividad">Arte y creatividad</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="etiquetas[]" value="Entretenimiento" id="etiquetaEntretenimiento">
                                <label class="form-check-label" for="etiquetaEntretenimiento">Entretenimiento</label>
                            </div>
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