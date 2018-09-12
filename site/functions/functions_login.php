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
?>
