<?php
$titlePage = "Forgot Pass";
$requireLogin = TRUE;
include('./views/header.php');
$user = getConnectedUser($dbConnector);
if($user == null)
{
    logout();
    ?>
    <div class="panel panel-danger">
        <div class="panel-heading">My Account</div>
        <div class="panel-body">
            Please reconnect. You have been disconnected.
        </div>
    </div>
    <?php
}
else
{
    ?>
    <div class="panel panel-primary">
        <div class="panel-heading">My Account</div>
        <div class="panel-body">
            <form action="business/account.php" method="POST">
                <input type="hidden" name="token" value="<?=$user->getToken()?>"/>
                Login : <input type="text" name="login" autocomplete="off" value="<?=$user->login?>"/>
                <br/>Email : <input type="text" name="email" autocomplete="off" value="<?=$user->email?>"/>
                <br/>Change Password : <input type="password" name="passwd" value="" autofocus="autofocus" placeholder="8 characters"/>
                <br/>Confirm Password : <input type="password" name="passwd_confirm" value="" placeholder="8 characters"/>
                <br/><input type="submit" value="Save" class="btn btn-success"/>
            </form>
        </div>
    </div>
    <?php
}
?>


<?php
include('./views/footer.php');
?>