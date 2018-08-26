<?php
require_once("../model/DBConnector.php");
session_start();
require_once("../config/database.php");
require_once("../functions/functions.php");

if(!isset($_POST['email']) || !isset($_POST['login']) || !isset($_POST['token']))
{
    registerMessageHeader("Technical error.", "danger");
    header('location: ../account.php');
}

$email = htmlentities($_POST['email'], ENT_QUOTES, "UTF-8");
$login = htmlentities($_POST['login'], ENT_QUOTES, "UTF-8");
$token = htmlentities($_POST['token'], ENT_QUOTES, "UTF-8");

$currentUser = getConnectedUser($dbConnector);
$paramUserNOTIF_COMMENT_MYPIC = $dbConnector->getParamUser($currentUser->getID(),NOTIF_COMMENT_MYPIC);
$newValue = (isset($_POST[NOTIF_COMMENT_MYPIC]) && $_POST[NOTIF_COMMENT_MYPIC]=="on")?TRUE:FALSE;
$paramUserNOTIF_COMMENT_MYPIC->param_value=$newValue?1:0;
$dbConnector->saveParamUser($paramUserNOTIF_COMMENT_MYPIC);
registerMessageHeader("OK.", "success");
header('location: ../account.php');