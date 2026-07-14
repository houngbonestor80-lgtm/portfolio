<?php
/**
 * Point d'entree commun : session, config, fonctions, panier.
 * A inclure en toute premiere ligne de chaque page publique.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/cart.php';
