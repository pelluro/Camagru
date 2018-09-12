<?php
$titlePage = "Reset Password Page";
include('./views/header.php');
if (!isset($_GET['login']) || !isset($_GET['email']) || !isset($_GET['confirmation_code']))
{
    header("location: index.php");
    exit;
}
$login=$_GET['login'];
$email=$_GET['email'];
$token=$_GET['confirmation_code'];
$user = $dbConnector->getUserByEmailAndLoginAndToken($email,$login,$token);

if ($user == null) {
    registerMessageHeader("User unknown", "danger");
    header("location: index.php");
    exit;
}
?>
<div class="panel panel-info">
    <div class="panel-heading">Reset password</div>
	<div class="panel-body">
    <form id="form" action="business/password.php" method="POST">
        <input type="hidden" id="login" name="login" value="<?=$login?>"/>
        <input type="hidden" id="email" name="email" value="<?=$email?>"/>
        <input type="hidden" id="token" name="token" value="<?=$token?>"/>
        Password : <input type="password" id="passwd" name="passwd" autocomplete="off" autofocus="autofocus" value=""/>
        <br/>
        Confirm Password : <input type="password" id="passwd_confirm" name="passwd_confirm" autocomplete="off" value=""/>
        <br/>
        <input id="reset" type="submit" name="submit" value="Sign In" style="...">
    </form>
    <br/>
    <a href="password_forgotten.php"> Forgot Password ?</a>
	</div>
</div>
<?php
	include('./views/footer.php');
?>
