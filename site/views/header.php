<?php
require_once("./model/DBConnector.php");
session_start();
require_once("./config/database.php");
require_once("./functions/functions.php");
if(isset($requireLogin) && $requireLogin == TRUE && !isLoggedIn())
{
    header("location: index.php");
}
?>
<html>
<head>
    <link rel="stylesheet" href="./css/bootstrap.css">
	<link rel="stylesheet" href="./css/camagru.css">
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
                    <li><a href="./index.php">Galery</a></li>
                    <?php
                    if(isLoggedIn())
                    {
                    ?>
                    <li><a href="./camera.php">Camera</a></li>
                    <?php
                    }
                    ?>
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
                        <li><a href="./account.php">[<?=$_SESSION["currentUser_login"]?>]</a></li>
                        <li><a href="./logout.php">Sign out</a></li>
                        <?php
                    }
                    ?>

                </ul>
            </div>
        </div>
    </nav>
	<?php printMessageHeader();?>
