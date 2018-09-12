<?php
require_once "login_ecole.php";
//require_once "login_nas.php";
//require_once "login_surface.php";
try {
    $dbConnection = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbConnector = new DBConnector($dbConnection);
} catch (PDOException $ex) {
    die('Échec lors de la connexion : ' . $ex->getMessage());
}

