<?php
$titlePage = "Index";

include('./views/header.php');
if(isLoggedIn())
{
    include("main.php");
}
include('./views/footer.php');
?>
