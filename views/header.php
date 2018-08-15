<?php
session_start();
require_once("./config/database.php");
require_once("./functions/functions.php");
?>
<html>
<head>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <title><?=$titlePage?></title>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="./index.php">Camagru</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="../photos.php">Galery</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php
                    if(!isLoggedIn())
                    {
                        ?>
                        <li><a href="./login.php">Sign in</a></li>
                        <li><a href="./register.php">Sign up</a></li>
                        <?php
                    }
                    else
                    {
                        ?>
                        <li><a href="#">[<?=$_SESSION["login"]?>]</a></li>
                        <li><a href="./logout.php">Sign out</a></li>
                        <?php
                    }
                    ?>

                </ul>
            </div>
        </div>
    </nav>
	<?php printMessageHeader();?>