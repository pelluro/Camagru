<?php
session_start();
require_once("../config/database.php");
require_once("../functions/functions.php");

if(!isset($_POST['email']))
    {
        registerMessageHeader("no email provided", "danger");
        header('location: ../password_forgotten.php');
        exit;
    }

$email = htmlentities($_POST['email'], ENT_QUOTES, "UTF-8");
$user = $dbConnector->getUserByEmail($email);
if($user == null)
{
    registerMessageHeader("Email unknown.", "danger");
    header('location: ../password_forgotten.php');
    exit;
}
$user->resetToken();
$dbConnector->saveUser($user);
registerMessageHeader("An email has been sent to $email, please check for changing password.","warning");
mail_password($user);
header('location: ../index.php');
?>
