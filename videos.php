<?php

// Incluimos la plantilla
require_once 'template.php';

// Cal iniciar la sessió abans d'utilitzar la classe per a que $_SESSION estigui disponible
session_start();

// Llamamos a la función para imprimir la cabecera
imprimir_cabecera('Vídeos - Gaming Zone');

?>

<nav class="breadcrumbs">
    <div class="container">
        <a href="index.php">Inici</a> > <span>Vídeos</span>
    </div>
</nav>

<main class="main-content">
    <div class="container">
        <h1>Vídeos Gaming</h1>
        <p>Descobreix els millors vídeos sobre gaming, tutorials de construcció de PCs i reviews d'equipament.</p>

        <section class="video-section">
            <h2>Vídeo Destacat</h2>
            <div class="video-container">
                <video controls width="100%" height="400" poster="imatges/gaming_setup_1.jpg">
                    <source src="videos/gaming_video.mp4" type="video/mp4">
                    El teu navegador no suporta l'element video.
                </video>
                <div class="video-info">
                    <h3>Gaming Setup en Acció</h3>
                    <p>Vídeo que mostra un setup gaming professional en funcionament, perfecte per inspirar-te en la teva pròpia configuració.</p>
                </div>
            </div>
        </section>

        <section class="video-section">
            <h2>Tutorial: Com Construir un PC Gaming</h2>
            <div class="video-container">
                <div class="youtube-embed">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/Mho0M1Ns0Rw?si=NiHddY9nWP8Nnw9i" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
                <div class="video-info">
                    <h3>Guia Completa de Construcció de PC Gaming 2025</h3>
                    <p>Tutorial detallat que explica pas a pas com construir el teu propi ordinador gaming, des de la selecció de components fins al muntatge final.</p>
                </div>
            </div>
        </section>

        <section class="video-section">
            <h2>Llista de Reproducció Gaming</h2>
            <p>Selecció de vídeos que es reprodueixen automàticament en bucle.</p>
            <div class="playlist-container">
                <div class="playlist-video active">
                    <video id="playlist-video-1" width="100%" height="300" muted>
                        <source src="videos/gaming_video.mp4" type="video/mp4">
                        El teu navegador no suporta l'element video.
                    </video>
                    <h4>Vídeo 1: Gaming Setup</h4>
                </div>

                <div class="playlist-video">
                    <video id="playlist-video-2" width="100%" height="300" muted>
                        <source src="videos/gaming_video.mp4" type="video/mp4">
                        El teu navegador no suporta l'element video.
                    </video>
                    <h4>Vídeo 2: PC Building</h4>
                </div>

                <div class="playlist-video">
                    <video id="playlist-video-3" width="100%" height="300" muted>
                        <source src="videos/gaming_video.mp4" type="video/mp4">
                        El teu navegador no suporta l'element video.
                    </video>
                    <h4>Vídeo 3: Gaming Review</h4>
                </div>
            </div>

            <div class="playlist-controls">
                <button id="play-playlist" class="control-btn">▶ Reproduir Llista</button>
                <button id="pause-playlist" class="control-btn">⏸ Pausar</button>
                <button id="stop-playlist" class="control-btn">⏹ Aturar</button>
            </div>
        </section>

        <section class="video-grid">
            <h2>Més Vídeos</h2>
            <div class="video-grid-container">
                <div class="video-card">
                    <div class="video-thumbnail">
                        <img src="imatges/gaming_desktop_1.jpg" alt="PC Gaming Review">
                        <div class="play-overlay">▶</div>
                    </div>
                    <h3>Review: Millors PCs Gaming 2025</h3>
                    <p>Anàlisi dels ordinadors gaming més potents del mercat actual.</p>
                </div>

                <div class="video-card">
                    <div class="video-thumbnail">
                        <img src="imatges/gaming_laptop_1.jpg" alt="Gaming Laptop">
                        <div class="play-overlay">▶</div>
                    </div>
                    <h3>Portàtils Gaming: Guia de Compra</h3>
                    <p>Tot el que necessites saber abans de comprar un portàtil gaming.</p>
                </div>

                <div class="video-card">
                    <div class="video-thumbnail">
                        <img src="imatges/gaming_setup_2.jpg" alt="Setup Gaming">
                        <div class="play-overlay">▶</div>
                    </div>
                    <h3>Setup Gaming: Inspiració i Consells</h3>
                    <p>Idees per crear l'espai gaming perfecte a casa teva.</p>
                </div>
            </div>
        </section>
    </div>
</main>

<?php

// Llamamos a la función para imprimir el pie de página
imprimir_pie();

?>