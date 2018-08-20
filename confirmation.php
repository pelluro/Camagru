<?php
session_start();
require_once("./config/database.php");
require_once("./functions/functions.php");
if (!isset($_GET['login']) || !isset($_GET['email']) || !isset($_GET['confirmation_code']))
{
    header("location: index.php");
}
$login=$_GET['login'];
$email=$_GET['email'];
$token=$_GET['confirmation_code'];

$req= "SELECT id FROM users WHERE login = '$login' AND token ='$token' ";
$data=execQuerySelect($dbConnection, $req);
if ($data == null)
{
    registerMessageHeader("User unknown", "danger");
    header("location: index.php");
    exit;
}
$id=$data[0]['id'];
$req="UPDATE users SET verified = 1 WHERE id=$id";
execQuery($dbConnection, $req);
registerMessageHeader("Confirmation Success!", "success");
$_SESSION['login'] = $login;
$_SESSION['email'] = $email;
header("location: index.php");
?>
