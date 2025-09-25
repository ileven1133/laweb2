<?php

// Incluir las clases necesarias
require_once 'template.php';
require_once 'FileList.php';
require_once 'File.php';
require_once 'Upload.php';
require_once 'UploadException.php';

// Iniciar la sesion
session_start();

// Directorio para guardar las imagenes
$directori_imatges = 'imatges';

// Inicializar mensajes para la subida de archivos
$missatge_ok = '';
$missatge_error = '';

// Funcion para registrar errores en un archivo de log
function registrar_error_log($missatge) {
    $data_actual = date('Y-m-d H:i:s');
    $linia_log = $data_actual . " - " . $missatge . "\n";
    file_put_contents('error.log', $linia_log, FILE_APPEND | LOCK_EX);
}

// Procesar la subida del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_FILES['nova_imatge']) || $_FILES['nova_imatge']['error'] === UPLOAD_ERR_NO_FILE) {
        $missatge_error = "No s'ha seleccionat cap fitxer per pujar.";
        registrar_error_log("No s'ha seleccionat cap fitxer per pujar.");
    } elseif ($_FILES['nova_imatge']['error'] !== UPLOAD_ERR_OK) {
        $error_code = $_FILES['nova_imatge']['error'];
        $missatge_error = "Ha ocorregut un error en la pujada amb codi: " . $error_code;
        registrar_error_log("Ha ocorregut un error en la pujada amb codi: " . $error_code);
    } else {
        try {
            // Intentar subir la imagen usando la clase Upload
            Upload::save(
                'nova_imatge',
                $directori_imatges,
                true,
                2000000,
                'image/*'
            );
            
            $missatge_ok = "La imatge s'ha pujat correctament!";
        } catch (UploadException $e) {
            // Capturar y registrar la excepcion si la subida falla
            $missatge_error = "Error en la pujada: " . $e->getMessage();
            registrar_error_log("Error en la pujada: " . $e->getMessage());
        }
    }
}

// Imprimir la cabecera
imprimir_cabecera('Galeria - Gaming Zone');

?>

<nav class="breadcrumbs">
    <div class="container">
        <a href="index.php">Inici</a> &gt; <span>Galeria</span>
    </div>
</nav>

<main class="main-content">
    <div class="container">
        <h1>Galeria Gaming</h1>
        <p>Explora la nostra col·lecció de setups, ordinadors i components gaming d'alta gamma.</p>

        <?php 
            // Mostrar el formulario de subida solo si el usuario esta logeado
            if (Session::has('loggedin')) { 
        ?>
            <section class="upload-section">
                <h2>Puja la teva imatge</h2>
                <?php if (!empty($missatge_ok)): ?>
                    <p class="success-message"><?php echo htmlspecialchars($missatge_ok); ?></p>
                <?php endif; ?>
                <?php if (!empty($missatge_error)): ?>
                    <p class="error-message"><?php echo htmlspecialchars($missatge_error); ?></p>
                <?php endif; ?>
                <form action="galeria.php" method="post" enctype="multipart/form-data" class="upload-form">
                    <div class="form-group">
                        <label for="nova_imatge">Selecciona una imatge:</label>
                        <input type="file" name="nova_imatge" id="nova_imatge" required>
                    </div>
                    <button type="submit" class="submit-btn">Pujar Imatge</button>
                </form>
            </section>
        <?php 
            }
        ?>

        <section class="gallery-section">
            <div class="gallery-grid">
                <?php
                // Listar las imagenes del directorio
                $fitxers = FileList::files($directori_imatges, ['jpg', 'jpeg', 'png', 'gif']);
                foreach ($fitxers as $fitxer) {
                    $path_complet = $fitxer->getPath();
                    $nom_fitxer = $fitxer->getFilename();
                    $nom_sense_extensio = pathinfo($nom_fitxer, PATHINFO_FILENAME);
                    $titol_imatge = str_replace(['_', '-'], ' ', $nom_sense_extensio);
                    $titol_imatge = ucwords($titol_imatge);
                ?>
                    <div class="gallery-item" onclick="openLightbox('<?php echo htmlspecialchars($path_complet); ?>', '<?php echo htmlspecialchars($titol_imatge); ?>')">
                        <img src="<?php echo htmlspecialchars($path_complet); ?>" alt="<?php echo htmlspecialchars($titol_imatge); ?>">
                        <div class="gallery-overlay">
                            <h3><?php echo htmlspecialchars($titol_imatge); ?></h3>
                            <p>Imatge pujada per l'usuari</p>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </section>

        <div id="lightbox" class="lightbox" onclick="closeLightbox()">
            <div class="lightbox-content">
                <img id="lightbox-img" src="" alt="">
                <div class="lightbox-caption">
                    <h3 id="lightbox-title"></h3>
                </div>
                <span class="close-btn" onclick="closeLightbox(); event.stopPropagation();">&times;</span>
            </div>
        </div>
    </div>
</main>
<?php
// Imprimir el pie de pagina
imprimir_pie();
?>