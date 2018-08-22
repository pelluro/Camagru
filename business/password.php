    <?php
session_start();
require_once("../config/database.php");
require_once("../functions/functions.php");

print_array($_POST);

if(!isset($_POST['email']) || !isset($_POST['login']) || !isset($_POST['passwd_confirm']) || !isset($_POST['passwd']) || !isset($_POST['token']))
    {
        registerMessageHeader("no password provided", "danger");
        header('location: ../password_forgotten.php');
    }

$email = htmlentities($_POST['email'], ENT_QUOTES, "UTF-8");
$login = htmlentities($_POST['login'], ENT_QUOTES, "UTF-8");
$token = htmlentities($_POST['token'], ENT_QUOTES, "UTF-8");

if($_POST['passwd'] != $_POST['passwd_confirm'])
{
    registerMessageHeader("password no match", "danger");
    header("location: ../password_reset.php?login=$login&email=$email&confirmation_code=$token");
    exit;
}


$req = "SELECT * FROM users WHERE email ='$email' AND login='$login' AND token='$token'";

$data= execQuerySelect($dbConnection,$req);

if($data == null)
{
    registerMessageHeader("User unknown.", "danger");
    header('location: ../password_forgotten.php');
    exit;
}
$user=$data[0];
$userid = $user['id'];
$passwd = htmlentities($_POST['passwd'], ENT_QUOTES, "UTF-8");
$passwd = hash('whirlpool',$passwd);

$req="UPDATE users SET passwd ='$passwd',verified=1 WHERE id=$userid";
execQuery($dbConnection,$req);
registerMessageHeader("Password changed ok.","success");
header('location: ../index.php');
?>
