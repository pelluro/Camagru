<?php
function mail_confirmation($email, $login, $guid)
{
    $subject = "Email confirmation";
    $headers = 'Content-Type: text/html; charset=ISO-8859-1' . "\r\n" . 'From: noreply@camagru.com' . "\r\n" . 'X-Mailer: PHP/' .phpversion();
    $message ="Bienvenue sur Camagru!";
    ?>
    <table class="w580" width="580" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td class="w580" width="580">
                <h2 style="color:#0E7693; font-size:22px; padding-top:12px;"> Account verification  </h2>
                <div align="left" class="article-content">
                    <p>Hi '.$login.'</p>
                    <p>Please click on the below link to verify your account</p>
                    <a href="<?=str_replace("register","confirmation",$_SERVER["HTTP_REFERER"])?>?login='<?=$login?>'&email='<?=$email?>'&confirmation_code='{<?=$guid?>}'">Confirm my account</a>
                    <p>You will not have access to camagru until you click on the above link</p>
                </div>
            </td>
        </tr>
        <tr>
            <td class="w580" width="580" height="1" bgcolor="#c7c5c5"></td>
        </tr>
    </table>
    <?php
    mail($email, $subject, $message, $headers);
}


function mail_password($email, $login, $rand)
{
$subject = "Reset Your Password";
$headers = 'Content-Type: text/html; charset=ISO-8859-1' . "\r\n" . 'From: noreply@camagru.com' . "\r\n" . 'X-Mailer: PHP/' .phpversion();
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
