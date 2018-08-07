<?php
	session_start();
	unset($_SESSION['loggued_on_user']);
	header("location: index.php");
?>