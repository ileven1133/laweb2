<?php
require 'session_manager.php';
require 'template.php';

// Si l'usuari ja ha iniciat sessió, el redirigim a la pàgina d'inici
if (Session::has('loggedin')) {
    header("Location: index.php");
    exit();
}

imprimir_cabecera('Login - Gaming Zone');
?>
<div class="breadcrumbs">
    <a href="index.php">Inici</a> &gt; Inicia Sessió
</div>

<div class="container">
    <section class="form-section">
        <h2>Accedeix al teu compte</h2>
        <form id="login-form-page" action="login.php" method="post">
            <div class="form-group">
                <label for="login-username">Nom d'usuari o Email</label>
                <input type="text" id="login-username" name="username" required placeholder="El teu nom d'usuari o email">
            </div>
            <div class="form-group">
                <label for="login-password">Contrasenya</label>
                <input type="password" id="login-password" name="password" required placeholder="La teva contrasenya">
            </div>
            <div class="form-group checkbox-group">
                <label class="checkbox-label">
                    <input type="checkbox" id="login-remember-me" name="remember">
                    <span class="checkmark"></span>
                    Recorda'm
                </label>
            </div>
            <button type="submit" class="submit-btn">Iniciar Sessió</button>
        </form>
        <div class="form-link-container">
            <p><a href="#" class="form-link">Has oblidat la contrasenya?</a></p>
            <p>No tens un compte? <a href="registre.php" class="form-link">Registra't</a></p>
        </div>
    </section>
</div>
<?php
imprimir_pie();
?>