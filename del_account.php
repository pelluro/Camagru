<?php
	session_start();
	require_once dirname(__FILE__)."/functions/connection.php";
	$login = mysqli_real_escape_string($db, $_SESSION['loggued_on_user']);
	$sql = "DELETE FROM users_shop where username='$login'";
	mysqli_query($db, $sql);
	unset($_SESSION['loggued_on_user']);
	header("location: index.php");
?>