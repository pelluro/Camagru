<?php
$titlePage = "Confirmation Page";
include('./views/header.php');

if (!isset($_GET['login']) || !isset($_GET['email']) || !isset($_GET['confirmation_code']))
{
    header("location: index.php");
}
$login=$_GET['login'];
$email=$_GET['email'];
$token=$_GET['confirmation_code'];


?>



<?php
include('./views/footer.php');
?>
