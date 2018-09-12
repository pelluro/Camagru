<?php
require_once "login_ecole_setup.php";
//require_once "login_nas_setup.php";
//require_once "login_surface_setup.php";
try {
    $dbConnection = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    die('Échec lors de la connexion : ' . $ex->getMessage());
}
?>
