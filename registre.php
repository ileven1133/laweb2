<?php
// registre.php
require 'template.php';

// Cal iniciar la sessió abans d'utilitzar la classe per a que $_SESSION estigui disponible
session_start();

// Llamamos a la cabecera
imprimir_cabecera('Registre - Gaming Zone');

// -------------------------------------------------------------------------------------
// Lógica para procesar el formulario de registro cuando se envía
// -------------------------------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger todos los datos del formulario, incluyendo los campos adicionales
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];
    $accepts_terms = isset($_POST['accepts-terms']);

    // Campos adicionales del formulario
    $full_name = $_POST['full_name'];
    $birthdate = $_POST['birthdate'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $country = $_POST['country'];
    $postal_code = $_POST['postal_code'];

    // Validar que las contraseñas coincidan
    if ($password !== $confirm_password) {
        echo '<p class="error-message">Error: Las contraseñas no coinciden.</p>';
    } elseif (!$accepts_terms) {
        // Validación para los términos y condiciones
        echo '<p class="error-message">Error: Debes aceptar los Términos y condiciones.</p>';
    } else {
        // TODO: lògica de BBDD
        // Aquí es donde iría la lógica de base de datos
        // para insertar todos los datos del formulario.
    }
}
?>

<nav class="breadcrumbs">
    <div class="container">
        <a href="index.php">Inici</a> &gt; <span>Registre</span>
    </div>
</nav>

<div class="container">
    <section class="form-section">
        <h2>Crea el teu compte</h2>
        <form id="register-form" action="registre.php" method="post">
            <div class="form-group">
                <label for="username">Nom d'usuari:</label>
                <input type="text" id="username" name="username" required placeholder="El teu nom d'usuari">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required placeholder="El teu email">
            </div>
            <div class="form-group">
                <label for="password">Contrasenya:</label>
                <input type="password" id="password" name="password" required placeholder="Crea la teva contrasenya">
            </div>
            <div class="form-group">
                <label for="confirm-password">Repeteix la contrasenya:</label>
                <input type="password" id="confirm-password" name="confirm-password" required placeholder="Repeteix la contrasenya">
            </div>

            <hr class="form-divider">

            <h3>Dades personals (Opcional)</h3>
            <div class="form-group">
                <label for="full_name">Nom i cognoms:</label>
                <input type="text" id="full_name" name="full_name" placeholder="El teu nom complet">
            </div>
            <div class="form-group">
                <label for="birthdate">Data de naixement:</label>
                <input type="date" id="birthdate" name="birthdate">
            </div>
            <div class="form-group">
                <label for="gender">Gènere:</label>
                <select id="gender" name="gender">
                    <option value="">Selecciona el teu gènere</option>
                    <option value="male">Home</option>
                    <option value="female">Dona</option>
                    <option value="other">Altres</option>
                </select>
            </div>
            <div class="form-group">
                <label for="address">Adreça:</label>
                <input type="text" id="address" name="address" placeholder="La teva adreça completa">
            </div>
            <div class="form-group">
                <label for="country">País:</label>
                <input type="text" id="country" name="country" placeholder="El teu país">
            </div>
            <div class="form-group">
                <label for="postal_code">Codi postal:</label>
                <input type="text" id="postal_code" name="postal_code" placeholder="Codi postal">
            </div>

            <div class="form-group checkbox-group">
                <label class="checkbox-label">
                    <input type="checkbox" id="accepts-terms" name="accepts-terms" required>
                    <span class="checkmark"></span>
                    Accepto els <a href="#" class="form-link">Termes i condicions</a>
                </label>
            </div>
            <button type="submit" class="submit-btn">Registrar-se</button>
        </form>
        <div class="form-link-container">
            <p>Ja tens un compte? <a href="login.php" class="form-link">Inicia sessió aquí</a></p>
        </div>
    </section>
</div>

<?php
// Cridem a la funció per imprimir el peu de pàgina
imprimir_pie();
?>