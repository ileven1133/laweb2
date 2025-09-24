<?php
// contacte.php

// Incluimos los archivos necesarios
require_once 'template.php';
require_once 'Session.php';
require_once 'Email.php';

// Iniciamos la sesión a cada página que la utilice
session_start();

// Lógica para procesar el envío del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Recogemos las datos del formulario
    $name    = $_POST['name'] ?? null;
    $email   = $_POST['email'] ?? null;
    $subject = $_POST['subject'] ?? null;
    $message = $_POST['message'] ?? null;

    // 2. Validamos los datos
    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
        
        // Dirección de correo donde recibirás el mensaje
        $recipient_email = 'feros62279@anysilo.com';

        try {
            // 3. Creamos una instancia de la clase Email
            $emailSender = new Email(
                $recipient_email,
                $subject,
                $message,
                $email, // La dirección del usuario que envía el mensaje
                $name  // El nombre del usuario que envía el mensaje
            );

            // 4. Enviamos el email
            $emailSender->send();
            
            // 5. Mensaje de confirmación
            Session::success('El teu missatge ha estat enviat correctament. Gràcies per contactar amb nosaltres!');
            
            // 🚨 ¡ATENCIÓ! Hemos eliminado la redirección 'header()' aquí.
            // Si rediriges, el mensaje flash no se mostrará en la página actual.
            // La ejecución continuará y la página se cargará con el mensaje.

        } catch (Exception $e) {
            // Si hay un error al enviar el email, guardamos el mensaje de error.
            Session::error('Hi ha hagut un error en enviar el missatge. Si us plau, torna-ho a intentar més tard.');
        }

    } else {
        // Si no se llenaron todos los campos, guardamos un mensaje de error.
        Session::error('Si us plau, omple tots els camps del formulari.');
    }
}

// Imprimimos la cabecera de la página
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
// Imprimimos el pie de página
imprimir_pie();
?>