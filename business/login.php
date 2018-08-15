<?php
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
    $passwd = hash('whirlpool', $passwd);
    $req = "SELECT email, login, passwd FROM users";
    $query = $dbConnection->prepare($req);
    $query->execute();
    if ($query->rowCount() > 0) {
        while ($data = $query->fetch()) {
            if ($login === $data['login'] AND $passwd === $data['passwd']) {
                $_SESSION['login'] = $login;
                $email = $data['email'];
                $_SESSION['email'] = $email;
                registerMessageHeader("Connection successful.","success");
                header('location: ../index.php');
                exit;
            } else
			{
				registerMessageHeader("Incorrect login or password.","danger");
                header('location: ../login.php');
			}
        }
    }
    else
	{
		registerMessageHeader("Unknown account.","danger");
        header('location: ../login.php');
	}
    $query->closeCursor();
}
?>