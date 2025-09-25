<?php
// Inclusion de los archivos necesarios
require_once 'template.php';
require_once 'Session.php';
require_once 'Email.php';

// Iniciar la sesion
session_start();

// Procesar el formulario de contacto si se ha enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Recoger los datos del formulario
    $name    = $_POST['name'] ?? null;
    $email   = $_POST['email'] ?? null;
    $subject = $_POST['subject'] ?? null;
    $message = $_POST['message'] ?? null;

    // 2. Validar que los campos no esten vacios
    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
        
        // Direccion de correo del destinatario
        $recipient_email = 'feros62279@anysilo.com';

        try {
            // 3. Crear una instancia de la clase Email
            $emailSender = new Email(
                $recipient_email,
                $subject,
                $message,
                $email,
                $name
            );

            // 4. Enviar el email
            $emailSender->send();
            
            // 5. Mostrar un mensaje de confirmacion
            Session::success('El teu missatge ha estat enviat correctament. Gràcies per contactar amb nosaltres!');
            
        } catch (Exception $e) {
            // Manejar errores si el email no se puede enviar
            Session::error('Hi ha hagut un error en enviar el missatge. Si us plau, torna-ho a intentar més tard.');
        }

    } else {
        // Mostrar un mensaje de error si faltan campos por rellenar
        Session::error('Si us plau, omple tots els camps del formulari.');
    }
}

// Imprimir la cabecera de la pagina
imprimir_cabecera('Contacte - Gaming Zone');
?>
<div class="breadcrumbs">
    <a href="index.php">Inici</a> &gt; Contacte
</div>

<div class="container">
    <section class="form-section">
        <h2>Contacta amb nosaltres</h2>
        <form action="contacte.php" method="post">
            <div class="form-group">
                <label for="contact-name">Nom:</label>
                <input type="text" id="contact-name" name="name" required>
            </div>
            <div class="form-group">
                <label for="contact-email">Email:</label>
                <input type="email" id="contact-email" name="email" required>
            </div>
            <div class="form-group">
                <label for="contact-subject">Assumpte:</label>
                <input type="text" id="contact-subject" name="subject" required>
            </div>
            <div class="form-group">
                <label for="contact-message">Missatge:</label>
                <textarea id="contact-message" name="message" rows="6" required></textarea>
            </div>
            <button type="submit" class="submit-btn">Enviar Missatge</button>
        </form>
    </section>
</div>
<?php
// Imprimir el pie de pagina
imprimir_pie();
?>