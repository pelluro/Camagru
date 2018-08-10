<?php
function is_in_array($value, $array)
{
	foreach($array as $row)
	{
		if($row == $value)
			return TRUE;
	}
	return FALSE;
}

function getGUID(){
    if (function_exists('com_create_guid')){
        return com_create_guid();
    }else{
        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = chr(123)// "{"
            .substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid,12, 4).$hyphen
            .substr($charid,16, 4).$hyphen
            .substr($charid,20,12)
            .chr(125);// "}"
        return $uuid;
    }
}

function mail_confirmation($email, $login, $rand)
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
                    <a href="http://localhost:8080/camagru/confirmation.php?login='.$login.'&email='.$email.'&confirmation_code='.$rand.'">Confirm my account</a>
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
?>
<?php
function mail_password($email, $login, $rand)
{
$subject = "Reset Your Password";
$headers = 'Content-Type: text/html; charset=ISO-8859-1' . "\r\n" . 'From: noreply@camagru.com' . "\r\n" . 'X-Mailer: PHP/' .phpversion();
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
</html>';
<?php
mail($email, $subject, $message, $headers);
}
?>
