<?php
// session_manager.php

// Aquest require és essencial per poder utilitzar la classe Session
require_once 'Session.php';

// Cal iniciar la sessió abans d'utilitzar la classe per a que $_SESSION estigui disponible
session_start();

/**
 * Funció per a simular la verificació de l'usuari.
 * @param string $username
 * @param string $password
 * @return bool
 */
function verifyUser($username, $password) {
    // Usuari de prova per a l'exercici
    return ($username === 'admin' && $password === '1234');
}

// Funció per a processar el login
function processLogin($username, $password) {
    if (verifyUser($username, $password)) {
        // Utilitzem els mètodes de la classe Session per a establir les variables
        Session::set('loggedin', true);
        Session::set('username', $username);
        Session::success("Has iniciat la sessió correctament!");
        return true;
    } else {
        Session::error("Nom d'usuari o contrasenya incorrectes.");
        return false;
    }
}

// Comprova si s'ha sol·licitat un logout
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    Session::destroy();
    header("Location: index.php");
    exit();
}

// Comprova si s'ha enviat el formulari de login (via POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    if (processLogin($_POST['username'], $_POST['password'])) {
        // Redirigeix a la pàgina d'inici si el login és correcte
        header("Location: index.php");
        exit();
    } else {
        // L'error es gestiona amb els missatges flash
    }
}
?>