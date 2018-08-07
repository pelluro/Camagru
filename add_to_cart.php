<?php
require_once dirname(__FILE__)."/functions/connection.php";
session_start();
if (isset($_GET['id']))
	$productid =  intval($_GET['id']);
if (isset($productid))
{
	$login = "no_user";
	if (isset($_SESSION['loggued_on_user']))
		$login = mysqli_real_escape_string($db, $_SESSION['loggued_on_user']);
	global $db;
	$sql = "SELECT id FROM card_shop WHERE user_id=(SELECT id FROM users_shop WHERE username='$login') AND state=0";
	$result = mysqli_query($db, $sql);
	$row = mysqli_fetch_array($result);
	# if user already has cart
	if ($row[0])
	{
		# get cart id
		$id = intval($row['id']);
		# add one to product
		$sql = "UPDATE card_shop_product SET amount = amount + 1 WHERE product_id='$productid' AND card_shop_id='$id'";
		mysqli_query($db, $sql);
		# add product to cart
		if (mysqli_affected_rows($db) == 0)
		{
			$sql = "INSERT INTO card_shop_product (card_shop_id,product_id,amount) VALUES ('$id','$productid',1)";
			mysqli_query($db, $sql);
		}
	}
	else
	{
		# create cart
		$sql = "INSERT INTO card_shop (user_id) VALUES ((SELECT id FROM users_shop WHERE username='$login'))";
		mysqli_query($db, $sql);
		# get cart id
		$sql = "SELECT id FROM card_shop WHERE user_id IN (SELECT id FROM users_shop WHERE username='$login')";
		$result = mysqli_query($db, $sql);
		$row = mysqli_fetch_array($result);
		$id = intval($row['id']);
		# add one to product
		$sql = "UPDATE card_shop_product SET amount = amount + 1 WHERE product_id='$productid' AND card_shop_id='$id'";
		mysqli_query($db, $sql);
		# add product to cart
		if (mysqli_affected_rows($db) == 0)
		{
			$sql = "INSERT INTO card_shop_product (card_shop_id,product_id,amount) VALUES ('$id','$productid',1)";
			mysqli_query($db, $sql);
		}
	}
}
header("Location: produit.php");
?>