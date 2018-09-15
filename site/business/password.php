<?php
include "include.php";

if(!isset($_POST['email']) || !isset($_POST['login']) || !isset($_POST['passwd_confirm']) || !isset($_POST['passwd']) || !isset($_POST['token']) || strlen($_POST["passwd"] )== 0)
{
    registerMessageHeader("No password provided", "danger");
    header('location: ../password_forgotten.php');
}
$email = htmlentities($_POST['email'], ENT_QUOTES, "UTF-8");
$login = htmlentities($_POST['login'], ENT_QUOTES, "UTF-8");
$token = htmlentities($_POST['token'], ENT_QUOTES, "UTF-8");
if($_POST['passwd'] != $_POST['passwd_confirm'])
{
    registerMessageHeader("password no match", "danger");
    header("location: ../password_reset.php?login=$login&email=$email&confirmation_code=$token");
    exit;
}
$user= $dbConnector->getUserByEmailAndLoginAndToken($email,$login,$token);
if($user == null)
{
    registerMessageHeader("User unknown.", "danger");
    header('location: ../password_forgotten.php');
    exit;
}
$passwd = htmlentities( $_POST['passwd'],ENT_QUOTES, "UTF-8");
$user->setPassword($passwd);
$user->verified=1;
$dbConnector->saveUser($user);
registerMessageHeader("Password changed ok.","success");
header('location: ../index.php');
exit;