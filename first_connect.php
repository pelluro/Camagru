<?php
    $titlePage = "Register";
    include('./header.php');
?>
<html>
<head>
    <body>
        <div class="alert-info">
            <h1> Create an account</h1>
            <div class="alert">
                <br id="contenu" action="register.php" method="POST">
                    <br/>
                    E-mail : <input type="email" name="email" value=""/>
                    <br/>
                    Login : <input type="text" name="login" size="30"/><br/>
                    Password : <input type="password">
                </form>
            </div>
        </div>
    </body>
</head>
</html>
