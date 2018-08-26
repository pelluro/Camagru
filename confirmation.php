<?php
require_once("./model/DBConnector.php");
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
$user = $dbConnector->getUserByEmailAndLoginAndToken($email,$login,$token);
if ($user == null)
{
    registerMessageHeader("User unknown", "danger");
    header("location: index.php");
    exit;
}
$user->verified=1;
$dbConnector->saveUser($user);
registerMessageHeader("Confirmation Success!", "success");
login($user);
header("location: index.php");
?>
