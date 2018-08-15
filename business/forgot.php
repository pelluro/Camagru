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
$req = "SELECT * FROM users WHERE email ='$email'";
$data= execQuerySelect($dbConnection,$req);

if($data == null)
{
    registerMessageHeader("Email unknown.", "danger");
    header('location: ../password_forgotten.php');
    exit;
}
$user=$data[0];
$userid = $user['id'];
$token = getGUID();
$req = "UPDATE users SET token='$token' WHERE id=$userid";
execQuery($dbConnection,$req);
registerMessageHeader("An email has been sent to $email, please check for changing password.","warning");
mail_password($email,$user['login'],$token);
header('location: ../index.php');
?>
