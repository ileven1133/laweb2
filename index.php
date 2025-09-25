<?php

// Inclusion de la plantilla
require_once 'template.php';

// Iniciar sesion
session_start();

// Imprimir la cabecera con el titulo de la pagina
imprimir_cabecera('Gaming Zone - Els millors ordinadors gaming');

?>

<section class="hero-slider">
    <div class="slider-container">
        <div class="slide active">
            <img src="imatges/gaming_setup_1.jpg" alt="Gaming Setup 1">
            <div class="slide-content">
                <h2>Descobreix els millors setups gaming</h2>
                <p>Equipament professional per a gamers exigents</p>
            </div>
        </div>
        <div class="slide">
            <img src="imatges/gaming_setup_2.jpg" alt="Gaming Setup 2">
            <div class="slide-content">
                <h2>Tecnologia d'última generació</h2>
                <p>Rendiment màxim per als teus jocs favorits</p>
            </div>
        </div>
        <div class="slide">
            <img src="imatges/gaming_setup_3.jpg" alt="Gaming Setup 3">
            <div class="slide-content">
                <h2>Disseny i funcionalitat</h2>
                <p>Estètica moderna amb prestacions excepcionals</p>
            </div>
        </div>
    </div>
</section>

<section class="about-section">
    <div class="container">
        <h2>Benvinguts a Gaming Zone</h2>
        <p>Gaming Zone és el teu destí definitiu per descobrir el món dels ordinadors gaming d'alta gamma. Ens hem especialitzat en oferir informació detallada sobre els millors equips, configuracions i accessoris per a gamers professionals i entusiastes.</p>
        <p>La nostra passió pels videojocs i la tecnologia ens ha portat a crear aquest espai on pots trobar tot el que necessites saber sobre hardware gaming, des de les últimes targetes gràfiques fins als perifèrics més innovadors del mercat.</p>
    </div>
</section>

<section class="featured-section">
    <div class="container">
        <h2>Destacats</h2>
        <div class="featured-grid">
            <div class="featured-item">
                <img src="imatges/gaming_desktop_1.jpg" alt="Gaming Desktop">
                <h3>PCs Gaming</h3>
                <p>Descobreix les millors configuracions per a gaming</p>
            </div>
            <div class="featured-item">
                <img src="imatges/gaming_laptop_1.jpg" alt="Gaming Laptop">
                <h3>Portàtils Gaming</h3>
                <p>Potència i portabilitat en un sol dispositiu</p>
            </div>
            <div class="featured-item">
                <img src="imatges/gaming_setup_4.jpg" alt="Gaming Setup">
                <h3>Setups Complets</h3>
                <p>Inspiració per al teu espai gaming perfecte</p>
            </div>
        </div>
    </div>
</section>

<?php

// Imprimir el pie de pagina
imprimir_pie();

?>