<?php
$titlePage = "Register";
include('./views/header.php');
?>
<div class="panel panel-info">
    <div class="panel-heading">
        Create an account
    </div>
	<div class="panel-body">
            <form id="container" action="business/register.php" method="POST">
                <br/>
                E-mail : <input type="email" name="email" value="" autocomplete="off" autofocus="autofocus" placeholder="Email" />
                <br/>
                Login : <input type="text" name="login" size="30" autocomplete="off" placeholder="Login" /><br/>
                Password : <input type="password" name="passwd" size="30" autocomplete="off" placeholder="8 characters"/> <br/>
            <input id="reset" type="submit" value="Register" style="width: 223px;">
            </form>
    </div>
</div>
<?php
include('./views/footer.php');
?>
