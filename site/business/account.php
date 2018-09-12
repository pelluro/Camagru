<?php
require_once("../model/DBConnector.php");
session_start();
require_once("../config/database.php");
require_once("../functions/functions.php");

if(!isset($_POST['email']) || !isset($_POST['login']) || !isset($_POST['passwd_confirm']) || !isset($_POST['passwd']) || !isset($_POST['token']) || strlen($_POST['passwd']) == 0)
{

    registerMessageHeader("No password provided", "danger");
    header('location: ../account.php');
}

$email = htmlentities($_POST['email'], ENT_QUOTES, "UTF-8");
$login = htmlentities($_POST['login'], ENT_QUOTES, "UTF-8");
$token = htmlentities($_POST['token'], ENT_QUOTES, "UTF-8");
if($_POST['passwd'] != $_POST['passwd_confirm'])
{
    print_array($_POST);
    registerMessageHeader("Passwords don't match.", "danger");
    header("location: ../account.php");
    exit;
}
$currentUser = getConnectedUser($dbConnector);
$users = $dbConnector->getUserByEmailOrLogin($email,$login);
if(count($users) > 0 && ((count($users)>1) || $users[0]->getID() != $currentUser->getID()))
{
    registerMessageHeader("This email or login is already used by another user.", "danger");
    header("location: ../account.php");
    exit;
}
$currentUser->email = $email;
$currentUser->login = $login;
$currentUser->setPassword($_POST['passwd']);
$dbConnector->saveUser($currentUser);
logout();
login($currentUser);
registerMessageHeader("OK.", "success");
header("location: ../account.php");
exit;