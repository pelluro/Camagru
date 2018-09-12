<?php
require_once("../model/DBConnector.php");
session_start();
require_once("../config/database.php");
require_once("../functions/functions.php");
if(!isset($_POST['login']) || !isset($_POST['passwd']))
{
	registerMessageHeader("No login or password provided.","danger");
    header('location: ../login.php');
    exit;
}
else
{
    $login = htmlentities($_POST['login'], ENT_QUOTES, "UTF-8");
    $passwd = htmlentities($_POST['passwd'], ENT_QUOTES,"UTF-8");
    $user = $dbConnector->getUser($login,$passwd);
    if($user != null)
    {
        login($user);
        registerMessageHeader("Connection successful.","success");
        header('location: ../index.php');
        exit;
    }
    else
    {
        registerMessageHeader("Incorrect login or password.","danger");
        header('location: ../login.php');
        exit;
    }
}

