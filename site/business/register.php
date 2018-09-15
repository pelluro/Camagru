<?php
include "include.php";

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
	if ($users != null && count($users) > 0)
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
        $userCreated = $dbConnector->getUserByEmailOrLogin($email,$login);
        $id = $userCreated[0]->getID();
        $paramUser = new ParamUser(null);
        $paramUser->user_id=$id;
        $paramUser->param_name = NOTIF_COMMENT_MYPIC;
        $paramUser->param_value = 1;
        $result2 = $dbConnector->saveParamUser($paramUser);
		if ($result && $result2)
		{
			registerMessageHeader(" <p>Thank You For Registering!</p> <p>An email has been sent to this address: <b>$email</b>.</p><p>Please click on the link you received to confirm your account.</p>","success");
			mail_confirmation($user);
			header('location: ../index.php');
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