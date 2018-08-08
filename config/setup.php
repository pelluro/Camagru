<?php
include "database.php";
function first_connect()
{
    try
    {
        $bdd = new PDO('mysql:host=localhost;charset=utf8', $DB_USER, $DB_PASSWORD);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e)
    {
        die('Erreur : '.$e->getMessage());
    }
    $req = 'CREATE DATABASE IF NOT EXISTS db_mipham; 
	USE db_mipham;
    CREATE TABLE IF NOT EXISTS users ( id INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
												email VARCHAR(64) NOT NULL default "",
												login VARCHAR(16) NOT NULL default "",
												passwd VARCHAR(128) NOT NULL default "",
												confirmation_code INT(11) NOT NULL, 
												active BINARY(1) NOT NULL default "0" );
			CREATE TABLE IF NOT EXISTS pictures ( pic_id INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
												pic_filename VARCHAR(19)NOT NULL default "",
												pic_filedate DATETIME,
												pic_login VARCHAR(16) NOT NULL default "",
												pic_email VARCHAR(64) NOT NULL default "");
			CREATE TABLE IF NOT EXISTS comments ( com_id INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
                                                 com_login VARCHAR(16) NOT NULL default "",
                                                 comment VARCHAR(250) NOT NULL default "",
                                                 pic_name VARCHAR(19) NOT NULL default "",
                                                 com_confirmation_code INT(11) NOT NULL, 
                                                 active BINARY(1) NOT NULL default "0" );
            CREATE TABLE IF NOT EXISTS likes    ( like_id INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
            									like_login VARCHAR(16) NOT NULL default "",
            									pic_name VARCHAR(19) NOT NULL default "");';
    $bdd->prepare($req)->execute();
}
$query = "CREATE TABLE users (
    id INT AUTO_INCREMENT,
    username varchar(255),
    password varchar(512) NOT NULL,
    PRIMARY KEY(id)
)";
function connect()
{
    first_connect();
    global $bdd;
    $DB_DSN = 'mysql:host=localhost;dbname=db_mipham;charset=utf8';
    try
    {
        $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e)
    {
        die('Erreur : '.$e->getMessage());
    }
    return $bdd;
}
?>