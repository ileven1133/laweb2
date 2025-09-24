<?php
// template.php
require_once 'Session.php';

function imprimir_cabecera($titulo)
{
    echo <<<HTML
    <!DOCTYPE html>
    <html lang="ca">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{$titulo}</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Electrolize&display=swap">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>
    <body>
        <a href="#main-content" class="skip-link">Saltar al contingut principal</a>
        <header class="header">
            <div class="header-main container">
                <div class="nav-brand">
                    <a href="index.php" class="logo">
                        <img src="imatges/logo.png" alt="Logo de Gaming Zone">
                    </a>
                </div>

                <button class="mobile-menu-toggle" aria-label="Toggle mobile menu">
                    <i class="fas fa-bars"></i>
                </button>

                <nav class="nav-menu">
                    <ul>
                        <li><a href="index.php">Inici</a></li>
                        <li><a href="galeria.php">Galeria</a></li>
                        <li><a href="videos.php">Vídeos</a></li>
                        <li><a href="contacte.php">Contacte</a></li>
                    </ul>
                </nav>

                <div class="nav-actions">
HTML;
    // Lògica per mostrar els enllaços segons l'estat de la sessió amb la classe Session
    if (Session::has('loggedin')) {
        // Usuari logejat
        echo '<span class="user-greeting">Hola, ' . htmlspecialchars(Session::get('username')) . '!</span>';
        echo '<a href="session_manager.php?action=logout" class="btn-icon" title="Tancar Sessió">';
        echo '<i class="fas fa-sign-out-alt"></i>';
        echo '</a>';
    } else {
        // Usuari no logejat
        echo '<a href="login.php" class="btn-icon" title="Login">';
        echo '<i class="fas fa-user-circle"></i>';
        echo '</a>';
        echo '<a href="registre.php" class="btn-icon" title="Registre">';
        echo '<i class="fas fa-plus-circle"></i>';
        echo '</a>';
    }
    echo <<<HTML
                </div>
            </div>
        </header>
        <main id="main-content">
HTML;
    // Mostrem els missatges flash
    if (Session::getFlash('success')) {
        echo '<div class="alert success">';
        echo '<p>Missatge enviat correctament</p>';
        echo '<p>' . htmlspecialchars(Session::getFlash('success')) . '</p>';
        echo '</div>';
    }
    if (Session::getFlash('error')) {
        echo '<div class="alert error">';
        echo '<p>Error en enviar</p>';
        echo '<p>' . htmlspecialchars(Session::getFlash('error')) . '</p>';
        echo '</div>';
}
}

function imprimir_pie()
{
    echo <<<HTML
    </main>
        <footer class="footer">
            <div class="container">
                <div class="footer-content">
                    <div class="footer-section about-us">
                        <h3>Sobre Nosaltres</h3>
                        <p>Gaming Zone és el teu destí definitiu per a tot allò relacionat amb el gaming. Tota la informació sobre equips, components i més.</p>
                    </div>
                    <div class="footer-section navigation">
                        <h3>Navegació</h3>
                        <ul>
                            <li><a href="index.php">Inici</a></li>
                            <li><a href="galeria.php">Galeria</a></li>
                            <li><a href="videos.php">Vídeos</a></li>
                            <li><a href="contacte.php">Contacte</a></li>
HTML;
    if (Session::has('loggedin')) {
        echo '<li><a href="session_manager.php?action=logout">Tancar Sessió</a></li>';
    } else {
        echo '<li><a href="login.php">Login</a></li>';
        echo '<li><a href="registre.php">Registre</a></li>';
    }
    echo <<<HTML
                        </ul>
                    </div>
                    <div class="footer-section">
                        <h3>Contacte</h3>
                        <p>Email: info@gamingzone.cat</p>
                        <p>Telèfon: +34 123 456 789</p>
                    </div>
                    <div class="footer-section social-media">
                        <h3>Segueix-nos</h3>
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="footer-bottom">
                    <p>&copy; 2024 Gaming Zone. Tots els drets reservats.</p>
                </div>
            </div>
        </footer>

    <div id="cookie-notice" class="cookie-notice">
        <div class="cookie-content">
            <p>Este sitio usa cookies para mejorar tu experiencia. Al continuar, aceptas su uso.</p>
            <div class="cookie-actions">
                <button id="cookie-accept" class="cookie-btn">Aceptar</button>
            </div>
        </div>
    </div>

    <script src="js/script.js"></script>
    </body>
    </html>
HTML;
}
?>