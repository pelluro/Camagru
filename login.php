<?php
session_start();
require_once ('config/setup.php');
if(!$_POST['login'] || $_POST['passwd'] || $_POST['submit'] != "Sign In")
{
    header('location: error_connexion.php');
    exit;
}
else
{
    $login = htmlentities($_POST['login'], ENT_QUOTES, "UTF-8");
    $passwd = htmlentities($_POST['passwd'], ENT_QUOTES,"UTF-8");
    $passwd = hash('whirpool', $passwd);
    connect();
}
$req = "SELECT email, login, passwd FROM users";
$query = $bdd->prepare($req);
$query->execute();
if ($query->rowCount() > 0)
{
    while ($data = $query->fetch())
    {
        if ($login === $data['login'] AND $passwd === $data['passwd'])
        {
            $_SESSION['login'] = $login;
            $email = $data['email'];
            $_SESSION['email'] = $email;
            header('location: main.php');
            exit;
        }
        else
            header('location: err_connexion.php');
    }
}
else
    header('location: err_connexion.php');
$query->closeCursor();
}

?>
