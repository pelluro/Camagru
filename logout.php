<?php
session_start();
require_once ("./functions/functions_login.php");
logout();
header("location: index.php");
?>