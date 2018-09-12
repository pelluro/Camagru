<?php
    $titlePage = "Connexion Page";
    include('./views/header.php');
?>
<div class="panel panel-info">
    <div class="panel-heading">Sign In</div>
	<div class="panel-body">
    <form id="form" action="business/login.php" method="POST">
        Login : <input type="text" id="login" name="login" autocomplete="off" value="" autofocus="autofocus" />
        <br/>
        Password : <input type="password" id="passwd" name="passwd" autocomplete="off" value=""/>
        <br/>
        <input id="reset" type="submit" name="submit" value="Sign In" style="...">
    </form>
    <br/>
    <a href="./password_forgotten.php"> Forgot Password ?</a>
	</div>
</div>
<?php
	include('./views/footer.php');
?>
