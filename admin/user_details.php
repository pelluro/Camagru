<?php
if(isset($_GET["action"]) && $_GET["action"] = "delete")
{
	$user = getuser($_GET["id"]);
	if($_SESSION['loggued_on_user'] != $user["username"])
		del_user($_GET["id"]);
}
$url = full_path_cleared();
header("Location: $url");
?>