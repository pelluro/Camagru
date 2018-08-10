<?php
    $titlePage = "Connexion Page";
	include('./header.php');
?>

<div class="alert-warning">
    <h1> Sign In</h1>
    <form id="form" action="login.php" method="post">
        Login : <input type="text" name="login" value=""/>
        <br/>
        Password : <input type="password" name="passwd" value=""/>
        <br/>
        <input id="reset" type="submit" name="submit" value="Sign In" style="...">
    </form>
    <br/>
    <a href="forgot_pass.php"> Forgot Password ?</a>
</div>
<?php
	include('./footer.php');
?>
