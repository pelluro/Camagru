<?php
require_once dirname(__FILE__)."../functions/connection_install.php";

if(!mysqli_query($db, "USE db_mipham"))
{
	mysqli_query($db, "CREATE DATABASE db_mipham");
}
mysqli_query($db, "USE db_mipham");

/*****************************
 * la table des utilisateurs
 *****************************/
$DB_DSN = 'mysql:host=localhost;charset=utf8';
$DB_USER = 'root';
$DB_PASSWORD = 'toto1234';
?>
