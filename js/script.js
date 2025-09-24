// script.js - Archivo JavaScript unificado

document.addEventListener('DOMContentLoaded', function () {
    // Inicializa todas las funcionalidades
    initSlider();
    initCookieNotice(); // Ahora el script de cookies se inicia aquí
    initFormHandlers();
    initLightbox();
    initVideoPlaylist();
    initKeyboardShortcuts();
    initMobileMenu();
    initSearchToggle();
    initRegisterFormHandlers();
});

// --- Funcionalidad del Hero Slider (Consolidado y Mejorado para Móvil, SOLO Automático) ---
function initSlider() {
    const heroSlider = document.querySelector('.hero-slider');
    if (!heroSlider) {
        return;
    }

    const slides = heroSlider.querySelectorAll('.slide');
    if (slides.length === 0) {
        return;
    }

    let currentSlideIndex = 0;
    let slideInterval;

    function showSlide(index) {
        currentSlideIndex = (index + slides.length) % slides.length;
        slides.forEach((slide, i) => {
            if (i === currentSlideIndex) {
                slide.classList.add('active');
            } else {
                slide.classList.remove('active');
            }
        });
    }

    function nextSlide() {
        showSlide(currentSlideIndex + 1);
    }

    function startSlider() {
        stopSlider();
        slideInterval = setInterval(nextSlide, 5000);
    }

    function stopSlider() {
        clearInterval(slideInterval);
    }

    startSlider();

    heroSlider.addEventListener('mouseenter', stopSlider);
    heroSlider.addEventListener('mouseleave', startSlider);
}

// --- Funcionalidad del Banner de Cookies ---
function initCookieNotice() {
    const cookieNotice = document.getElementById('cookie-notice');
    const cookieAcceptBtn = document.getElementById('cookie-accept');

    // Función para comprobar si una cookie existe
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
    }

    // Función para crear una cookie
    function setCookie(name, value, days) {
        let expires = '';
        if (days) {
            const date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = `; expires=${date.toUTCString()}`;
        }
        document.cookie = `${name}=${value}${expires}; path=/`;
    }

    // Comprobar si la cookie de aceptación ya existe.
    if (!getCookie('cookie-accepted')) {
        // Mostrar el banner añadiendo la clase 'show'
        if (cookieNotice) {
            cookieNotice.classList.add('show');
        }
    }

    // Manejar el clic en el botón de aceptar.
    if (cookieAcceptBtn) {
        cookieAcceptBtn.addEventListener('click', () => {
            setCookie('cookie-accepted', 'true', 365); // La cookie dura 1 año
            if (cookieNotice) {
                cookieNotice.classList.remove('show'); // Ocultar el banner quitando la clase 'show'
            }
        });
    }
}

// --- Funcionalidad de Menú Móvil --
function initMobileMenu() {
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const navMenu = document.querySelector('.nav-menu');

    if (mobileMenuToggle && navMenu) {
        mobileMenuToggle.addEventListener('click', () => {
            navMenu.classList.toggle('active');
        });
    }
}

// --- Funcionalidad del Formulario de Contacto (Si aplica) ---
function initFormHandlers() {
    // Si tu página tiene formularios, añade aquí la lógica
}

// --- Funcionalidad del Lightbox (Galería) ---
function initLightbox() {
    // Código para el lightbox si lo tienes en tu galería
}

// --- Funcionalidad de la Lista de Reproducción de Vídeos ---
function initVideoPlaylist() {
    // Lógica para el reproductor de vídeo
}

// --- Atajos de teclado ---
function initKeyboardShortcuts() {
    // Lógica para atajos de teclado
}

// --- Funcionalidad del Buscador (si aplica) ---
function initSearchToggle() {
    // Lógica para el buscador
}

// --- Funcionalidad del Formulario de Registro ---
function initRegisterFormHandlers() {
    const registerForm = document.getElementById('register-form-page');
    if (registerForm) {
        registerForm.addEventListener('submit', (event) => {
            const password = document.getElementById('reg-password').value;
            const confirmPassword = document.getElementById('reg-confirm-password').value;
            const acceptsTerms = document.getElementById('accepts-terms').checked;

            if (password !== confirmPassword) {
                alert('Las contraseñas no coinciden.');
                event.preventDefault();
                return;
            }

            if (!acceptsTerms) {
                alert('Has de aceptar los términos y condiciones.');
                event.preventDefault();
                return;
            }
        });
    }
}