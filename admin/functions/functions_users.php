<?php
require_once dirname(__FILE__)."/../../functions/functions.php";

function add_user($login, $psswd)
{
	global $db;
	$login = mysqli_real_escape_string($db, $login);
	$psswd = mysqli_real_escape_string($db, $psswd);
	$sql = "INSERT INTO users_shop (username, password) VALUES ('$login', '$psswd')";
	if (!mysqli_query($db, $sql))
	    die("Error: " . $sql . "<br>Stacktrace :" . mysqli_error($db));
}

function del_user($user_id)
{
	global $db;
	$user_id = intval($user_id);
	$sql = "DELETE card_shop_product FROM card_shop_product INNER JOIN card_shop on card_shop.id = card_shop_product.card_shop_id WHERE card_shop.user_id = $user_id";
	if (!mysqli_query($db, $sql))
	    die("Error: " . $sql . "<br>Stacktrace :" . mysqli_error($db));
	$sql = "DELETE card_shop FROM card_shop WHERE user_id = $user_id";
	if (!mysqli_query($db, $sql))
	    die("Error: " . $sql . "<br>Stacktrace :" . mysqli_error($db));
	$sql = "DELETE users_shop FROM users_shop WHERE id = $user_id";
	if (!mysqli_query($db, $sql))
	    die("Error: " . $sql . "<br>Stacktrace :" . mysqli_error($db));
}

function update_user($user_id, $nom, $password)
{
	global $db;
	$user_id = intval($user_id);
	$nom = mysqli_real_escape_string($db, $nom);
	$password = mysqli_real_escape_string($db, $password);
	$sql = "UPDATE users_shop SET username = '$nom', password='$password' WHERE id = $user_id";
	if (!mysqli_query($db, $sql))
	    die("Error: " . $sql . "<br>Stacktrace :" . mysqli_error($db));
}

function getusers()
{
	global $db;
	$sql = "SELECT id, username from users_shop";
	$resultat;
	$res = mysqli_query($db, $sql);
	while ($row = mysqli_fetch_assoc($res))
		$resultat[] = $row;
	return $resultat;
}

function getuser($user_id)
{
	global $db;
	$user_id = intval($user_id);
	$sql = "SELECT id, username from users_shop WHERE users_shop.id = $user_id";
	$resultat;
	$res = mysqli_query($db, $sql);
	return mysqli_fetch_assoc($res);
}

function getcardshop($user_id)
{
	global $db;
	$user_id = intval($user_id);
	$sql = "SELECT product_shop.id as productid, product_shop.name as productname, product_shop.price, card_shop_product.amount
		FROM card_shop_product
		JOIN card_shop on card_shop.id = card_shop_product.card_shop_id
		JOIN users_shop on users_shop.id = card_shop.user_id
		JOIN product_shop on product_shop.id = card_shop_product.product_id
		WHERE users_shop.id = $user_id";
	$resultat = NULL;
	$res = mysqli_query($db, $sql);
	while ($row = mysqli_fetch_assoc($res))
		$resultat[] = $row;
	return $resultat;
}

?>