<?php
$titlePage = "Login Page";
include('./views/header.php');
print_array($_POST);

if(!isset($_POST['login']) || !isset($_POST['passwd']))
{
    header('location: error_connexion.php');
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
                $_SESSION['firstlogin'] = 1;
                header('location: index.php');
                exit;
            } else
                header('location: error_connexion.php');
        }
    }
    else
        header('location: error_connexion.php');
    $query->closeCursor();
}

include('./views/footer.php');
?>
