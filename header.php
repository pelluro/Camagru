<?php
session_start();
require_once ("./config/database.php");
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
                <a class="navbar-brand" href="index.php">Camagru</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="page.php">Galery</a></li>
                    <li><a href="#">Sign in</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Sign up</a></li>
                </ul>
            </div>
        </div>
    </nav>