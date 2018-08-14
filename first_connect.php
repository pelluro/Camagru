<?php
    $titlePage = "Register";
include('./views/header.php');
?>
    <div class="alert-info">
        <h1> Create an account</h1>
        <div class="alert-success">
            <form id="container" action="register.php" method="POST">
                <br/>
                E-mail : <input type="email" name="email" value=""/>
                <br/>
                Login : <input type="text" name="login" size="30"/><br/>
                Password : <input type="password" name="passwd" size="30"/> <br/>
            <input id="reset" type="submit" value="Register" style="width: 223px;">
            </form>
        </div>
    </div>
<?php
include('./views/footer.php');
?>
