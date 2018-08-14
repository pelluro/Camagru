<?php
$titlePage = "Mon titre 2";
include('./views/header.php');

    if(!isset($_POST['email']) || !isset($_POST['login']) || !isset($_POST['passwd'])  || strlen($_POST['passwd']) < 8)
    {
        header('location: error_register.php');
        exit;
    }
    else
    {
        $email = htmlentities($_POST['email'], ENT_QUOTES, "UTF-8");
        $login = htmlentities($_POST['login'], ENT_QUOTES, "UTF-8");
        $passwd = htmlentities($_POST['passwd'], ENT_QUOTES, "UTF-8");
        $passwd = hash('whirlpool',$passwd);
        $req = "SELECT id FROM users WHERE login ='$login' OR email ='$email'";
        $query = $dbConnection->prepare($req);
        $query->execute();
        if ($query->rowCount() > 0)
        {
            header( "refresh:10;url=connexion.php");?>
            <div class= "alert alert-danger">
                <p>This login or email address is already used. Please try another one!</p>
            </div>
            <?php
        }
        else
        {
            $token = getGUID();
            $req =  "INSERT INTO users(email, login, passwd, token, verified) VALUES( '$email', '$login', '$passwd', '$token', 0)";
            $query = $dbConnection->prepare($req);
            $result = $query->execute();
            if ($result)
            {
                header( "refresh:10;url=connexion.php");?>
                <div class="alert alert-success">
                    <p>Thank You For Registering!</p>
                </div>
                <div class="alert alert-info">
                    <p>An email has been sent to this address: <b><?=$email?></b></p>
                    <p>Please click on the link you received to confirm your account.</p>
                </div>
                <?php

            }
            else
                echo "<p>Sorry, there has been a problem inserting your details. Please contact admin.</p>";
        }
        $query->closeCursor();
    }
include('./views/footer.php');
?>