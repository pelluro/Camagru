<?php
$titlePage = "Revoyer mail";
include('./header.php');

if(!$_POST['email'] || $_POST['submit'] != "Send me reset instructions")
    header('location: forgot_pass.php');
else
{
    $email = htmlentities($_POST['email'], ENT_QUOTES, "UTF-8");
    $req = "SELECT * FROM users WHERE email ='?'";
    $query = $dbConnection->prepare($req);
    $query->execute();
    while ($data = $query->fetch())
    {
        $login = $data['login'];
        $rand = $data['confirmation_code'];
    }
    if ($query->rowCount() > 0)
    {
        header( "refresh:10;url=connexion.php");
        mail_password($email, $login, $rand);?>
        <div class="alert alert-danger">

        <h1>Well Done For Forgetting your Password!</h1>
        </br>
        <h2>An email has been sent to this address: <?=$email?></h2>
        <p>Please click on the link you received to reset your password</p>
        </div>
        <?php
    }
    else
    {
        ?>
            <h1>Email Error. Sorry, this email address is not valid. Try again!</h1>
            <div class= "alert alert-info">
            <form id="form" action="forgot.php" method="POST">
                <input type="email" name="email" value placeholder="Email address"/>
                <br />
                <input id="reset" type="submit" name="submit" value="Send me reset instructions" style="width: 223px;" >
            </form>
        </div>

        <?php
    }
    $query->closeCursor();
}

include('./footer.php');
?>
