<?php
session_start();
require_once("../config/database.php");
require_once("../functions/functions.php");

if(!isset($_POST['email']) || !isset($_POST['login']) || !isset($_POST['passwd'])  || strlen($_POST['passwd']) < 8)
{
	registerMessageHeader("No login or no email or no password or too short password.","danger");
	header('location: ../register.php');
	exit;
}
else
{
	$email = htmlentities($_POST['email'], ENT_QUOTES, "UTF-8");
	$login = htmlentities($_POST['login'], ENT_QUOTES, "UTF-8");
	$passwd = htmlentities($_POST['passwd'], ENT_QUOTES, "UTF-8");
	$users = $dbConnector->getUserByEmailOrLogin($email,$login);
	if ($user != null && count($user) > 0)
	{
		registerMessageHeader("This login or email address is already used. Please try another one!","danger");
		header('location: ../register.php');
		exit;
	}
	else
	{
        $user = new User(null);
        $user->setPassword($passwd);
        $user->email=$email;
        $user->login=$login;
        $result = $dbConnector->saveUser($user);
		if ($result)
		{
			registerMessageHeader(" <p>Thank You For Registering!</p> <p>An email has been sent to this address: <b>$email</b>.</p><p>Please click on the link you received to confirm your account.</p>","success");
			mail_confirmation($user);
			header( "location: ../index.php");
			exit;
		}
		else
		{
			registerMessageHeader("Sorry, there has been a technical problem.","danger");
			header('location: ../register.php');
		}
	}
	$query->closeCursor();
}
?>