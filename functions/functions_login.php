<?php
function check_existing_login($login)
{
	global $db;
	$sql = "SELECT username FROM users_shop";
	$result = mysqli_query($db, $sql);
	while ($row = mysqli_fetch_array($result))
		if ($row[0] == $login)
			return TRUE;
	return FALSE;
}

function check_matching_psswd($login, $hash)
{
	global $db;
	$sql = "SELECT username,password FROM users_shop";
	$result = mysqli_query($db, $sql);
	while ($row = mysqli_fetch_array($result))
		if ($row[0] == $login && $row[1] == $hash)
			return TRUE;
	return FALSE;
}

function add_user($login, $psswd)
{
	global $db;
	$login = mysqli_real_escape_string($db, $login);
	$psswd = mysqli_real_escape_string($db, $psswd);
	$sql = "INSERT INTO users_shop (username, password) VALUES ('$login', '$psswd')";
	if (!mysqli_query($db, $sql))
	    die("Error: " . $sql . "<br>Stacktrace :" . mysqli_error($db));
}
?>