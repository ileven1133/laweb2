<?php

// Incloem les classes necessàries
require_once 'template.php';
require_once 'FileList.php';
require_once 'File.php';
require_once 'Upload.php';
require_once 'UploadException.php';

// Cal iniciar la sessió abans d'utilitzar la classe per a que $_SESSION estigui disponible
session_start();

// Definir la carpeta on es guarden les imatges de la galeria
$directori_imatges = 'imatges';

// Definir un estat de sessió simple per a la demostració
// NOTA: Aquest codi ja no és necessari si utilitzem la classe Session.
// Se substituirà per la comprovació de sessió.
// $usuari_identificat = true;

// Inicialitzar missatges per a la pujada de fitxers
$missatge_ok = '';
$missatge_error = '';

// Funció per a registrar errors en el fitxer 'error.log'
function registrar_error_log($missatge) {
    // Obtenim la data i hora actuals en el format "YYYY-MM-DD HH:MM:SS"
    $data_actual = date('Y-m-d H:i:s');
    
    // Creem la línia de log amb la data i el missatge d'error
    $linia_log = $data_actual . " - " . $missatge . "\n";
    
    // Escrivim la línia de log al fitxer 'error.log'
    // El flag FILE_APPEND assegura que el nou contingut s'afegeixi al final
    // LOCK_EX prevé que altres processos puguin escriure al mateix temps
    file_put_contents('error.log', $linia_log, FILE_APPEND | LOCK_EX);
}

// Comprovar si s'ha enviat el formulari de pujada
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Aquí el codi que ya tenías y que es correcto
    if (!isset($_FILES['nova_imatge']) || $_FILES['nova_imatge']['error'] === UPLOAD_ERR_NO_FILE) {
        $missatge_error = "No s'ha seleccionat cap fitxer per pujar.";
        registrar_error_log("No s'ha seleccionat cap fitxer per pujar.");
    } elseif ($_FILES['nova_imatge']['error'] !== UPLOAD_ERR_OK) {
        $error_code = $_FILES['nova_imatge']['error'];
        $missatge_error = "Ha ocorregut un error en la pujada amb codi: " . $error_code;
        registrar_error_log("Ha ocorregut un error en la pujada amb codi: " . $error_code);
    } else {
        try {
            // Processar la pujada del fitxer dins del bloc 'try'
            // NOTA: La classe Upload té mètodes estatics, no es crea una instància.
            // L'únic mètode que s'utilitza per pujar fitxers és el mètode 'save()'.
            
            // Utilitzem el mètode estatic save() de la classe Upload
            Upload::save(
                'nova_imatge',          // La clau de l'input de fitxers
                $directori_imatges,     // La carpeta de destí
                true,                   // Generar nom únic
                2000000,                // Mida màxima del fitxer (2 MB)
                'image/*'               // Tipus MIME permesos
            );
            
            $missatge_ok = "La imatge s'ha pujat correctament!";
        } catch (UploadException $e) {
            // Capturar la excepció si la pujada falla
            $missatge_error = "Error en la pujada: " . $e->getMessage();
            // Registrem l'error amb el missatge de l'excepció
            registrar_error_log("Error en la pujada: " . $e->getMessage());
        }
    }
}

// Cridem a la funció per imprimir la capçalera
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
            // Comprovem si l'usuari està identificat utilitzant la classe Session
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
            } // Tanca el bloc 'if'
        ?>

        <section class="gallery-section">
            <div class="gallery-grid">
                <?php
                // Llista els fitxers del directori d'imatges
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
// Cridem a la funció per imprimir el peu de pàgina
imprimir_pie();
?>