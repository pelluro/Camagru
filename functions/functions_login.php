<?php
function mail_confirmation($email, $login, $guid)
{
    $subject = "Email confirmation";
    $headers = 'From: Minh PHAM <no-reply@camagru.com>'."\r\n";
    $headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";
    $headers .= 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $message ="Bienvenue sur Camagru!";
    ?>
     <h2> Account verification</h2>
        <p>Hi <?=$login?></p>
        <p>Please click on the below link to verify your account</p>
    <a href="http://127.0.0.1:8100/Camagru/confirmation.php?login='<?=$login?>'&email='<?=$email?>'&confirmation_code='{<?=$guid?>}'">Confirm my account</a>
        <p>You will not have access to camagru until you click on the above link</p>
    <?php
    var_dump(mail($email, $subject, $message, $headers));
}

function mail_password($email, $login, $rand)
{
$subject = "Reset Your Password";
$headers = 'From: Minh PHAM <no-reply@camagru.com>'."\r\n";
$message="";
?>
<html>
<body>
<table class="w580" width="580" cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td class="w580" width="580">
            <h2 style="color:#0E7693; font-size:22px; padding-top:12px;"> Account verification  </h2>
            <div align="left" class="article-content">
                <p>Hi '.$login.'</p>
                <p>Someone has requested a link to change your password. You can do this through the link below.</p>
                <a href="http://localhost:8100/camagru/password.php?login='.$login.'&email='.$email.'&confirmation_code='.$rand.'">Change my password</a>
                <p>If you did not request this, please ignore this email</p>
                <p>Your password will not change until you access the link above and create a new one</p>
            </div>
        </td>
    </tr>
    <tr>
        <td class="w580" width="580" height="1" bgcolor="#c7c5c5"></td>
    </tr>
</table>
</body>
</html>
<?php
mail($email, $subject, $message, $headers);
}
?>
