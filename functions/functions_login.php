<?php
function isLoggedIn()
{
    if(isset($_SESSION["currentUser_login"])&&isset($_SESSION["currentUser_email"])&&isset($_SESSION["currentUser_token"]))
        return TRUE;
    return FALSE;
}

function login($user)
{
    $_SESSION["currentUser_login"]=$user->login;
    $_SESSION["currentUser_email"]=$user->email;
    $_SESSION["currentUser_token"]=$user->getToken();
}

function logout()
{
    unset($_SESSION["currentUser_login"]);
    unset($_SESSION["currentUser_email"]);
    unset($_SESSION["currentUser_token"]);
}

function getConnectedUser($dbConnector)
{
    if(!isLoggedIn())
        return null;
    $login = $_SESSION["currentUser_login"];
    $email = $_SESSION["currentUser_email"];
    $token = $_SESSION["currentUser_token"];
    return $dbConnector->getUserByEmailAndLoginAndToken($email,$login,$token);
}

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
    $message = '
  <html>
    <head>
      <title>' . $subject . '</title>
    </head>
    <body>
      Hello ' . htmlspecialchars($login) . ' </br>
      To finalyze your subscription please click the link below </br>
      <a href="http://localhost:8100/Camagru/confirmation.php?login='.$login.'&confirmation_code='.$guid.'">Verify my email</a>
    </body>
  </html>
  ';?>
    <?php
    var_dump(mail($email, $subject, $message, $headers));
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
    ';?>
    <?php
    var_dump(mail($email, $subject, $message, $headers));
}
?>
