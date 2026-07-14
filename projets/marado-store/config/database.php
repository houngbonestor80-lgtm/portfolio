<?php
/**
 * Connexion a la base de donnees MySQL (PDO)
 * Modifie ces constantes selon ta configuration locale (XAMPP/WAMP) ou ton hebergeur.
 */

define('DB_HOST', 'localhost');
define('DB_NAME', 'marado_store');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

// Nom de la boutique et infos generales (utilises dans tout le site)
define('SITE_NAME', 'Marado Store');
define('SITE_TAGLINE', 'Votre boutique de smartphones premium');
define('SITE_PHONE', '+229 01 00 00 00 00');
define('SITE_WHATSAPP', '22900000000');
define('SITE_EMAIL', 'contact@maradostore.com');
define('SITE_ADDRESS', 'Cotonou, Benin');
define('CURRENCY', 'FCFA');

function getDB(): PDO
{
    static $pdo = null;

    if ($pdo === null) {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            die('Erreur de connexion a la base de donnees. Verifie que MySQL est demarre et que la base "marado_store" existe (voir database/schema.sql). Detail : ' . $e->getMessage());
        }
    }

    return $pdo;
}
