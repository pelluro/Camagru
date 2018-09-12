<?php

function mail_confirmation($user)
{
    $login = $user->login;
    $guid = $user->getToken();
    $email = $user->email;
    $subject = "Email confirmation";
    $headers = 'From: Minh PHAM <no-reply@camagru.com>'."\r\n";
    $headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";
    $headers .= 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $message = '<html>
    <head>
      <title>' . $subject . '</title>
    </head>
    <body>
      Hello ' . htmlspecialchars($login) . ' </br>
      To finalize your subscription please click the link below </br>
      <a href="http://localhost:8100/Camagru/confirmation.php?login='.$login.'&confirmation_code='.$guid.'">Verify my email</a>
    </body>
  </html>
  ';
	try
	{
		mail($email, $subject, $message, $headers);
	}
	catch(Exception $e)
	{
		// RIEN ON VERRA
	}
}

function mail_password($user)
{
    $login = $user->login;
    $guid = $user->getToken();
    $email = $user->email;
    $subject = "Reset Your Password";
    $headers = 'From: Minh PHAM <no-reply@camagru.com>'."\r\n";
    $headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";
    $headers .= 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $message = '
    <html>
    <head>
      <title>' . $subject . '</title>
    </head>
    <body>
      Hello ' . htmlspecialchars($login) . ' </br>
                <p>Someone has requested a link to change your password. You can do this through the link below.</p>
                <a href="http://localhost:8100/Camagru/password_reset.php?login='.$login.'&confirmation_code='.$guid.'">Change my password</a>
                <p>If you did not request this, please ignore this email</p>
                <p>Your password will not change until you access the link above and create a new one</p>
            </body>
     </html>
    ';
	try
	{
		mail($email, $subject, $message, $headers);
	}
	catch(Exception $e)
	{
		// RIEN ON VERRA
	}
}

function mailnotif($user,$picture,$userfrom)
{
    $login = $user->login;
    $guid = $user->getToken();
    $email = $user->email;
    $subject = "Your picture {$picture->filename} has been commented !";
    $headers = 'From: Minh PHAM <no-reply@camagru.com>'."\r\n";
    $headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";
    $headers .= 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $message = "
  <html>
    <head>
      <title>$subject</title>
    </head>
    <body>
      Hello " . htmlspecialchars($login) . "</br>
      Your picture {$picture->filename} has been commented by <b>" . htmlspecialchars($userfrom->login) . "</b></br>
      <a href='http://localhost:8100/Camagru/photos.php?id=".$picture->getID()."'>Check yourself!</a>
    </body>
  </html>
  ";
	try
	{
		mail($email, $subject, $message, $headers);
	}
	catch(Exception $e)
	{
		// RIEN ON VERRA
	}
}