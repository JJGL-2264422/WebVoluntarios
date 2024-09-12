<?php
function incluir_navbar() {
    // Obtiene la ruta absoluta del directorio actual
    $current_directory = realpath(dirname($_SERVER['SCRIPT_FILENAME']));
   

    // Define las rutas de los directorios de las barras de navegación
    $Controlador_dir = realpath(__DIR__ . '/../controlador');
    $Modelo_dir = realpath(__DIR__ . '/../modelo');
    $Vista_dir = realpath(__DIR__ . '/../vista');
    $Vista_dir2 = realpath(__DIR__ . '/../vista/formularios');
    

    // Incluye la barra de navegación correspondiente según la carpeta actual
    if ($current_directory === $Controlador_dir) {
        include __DIR__ . '/../controlador/navbar_controlador.php';
    } elseif ($current_directory === $Modelo_dir) {
        include __DIR__ . '/../modelo/navbar_modelo.php';
    } elseif ($current_directory === $Vista_dir) {
        include __DIR__ . '/../vista/navbar_vista.php';
    }elseif ($current_directory === $Vista_dir2) {
        include __DIR__ . '/../vista/navbar_vista.php';
    }else {
        echo "No hay barra de navegación para esta carpeta.";
    }
}
function volver(){
    
    if ($_POST=['volver']){
        ?>
        <button><a href="../Vista/menu_admin.php"style="color:#0F0908;">Volver</a></button>
        <?php
        }
};
?>