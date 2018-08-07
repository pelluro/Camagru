<?php
	session_start();
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/menu.css">
	<link rel="stylesheet" type="text/css" href="css/categories.css">
	<title>Panier</title>
</head>
<body>
<?php
	include('./header.php');
	require_once dirname(__FILE__)."/functions/connection.php";
	global $db;
	$login = "no_user";
	if (isset($_SESSION['loggued_on_user']))
		$login = mysqli_real_escape_string($db, $_SESSION['loggued_on_user']);
	if (isset($_GET['action']))
	{
		global $db;
		$sql = "DELETE FROM card_shop WHERE state=0";
		$resultat3 = mysqli_query($db, $sql);
		header("location: cart.php");
	}
	if (isset($_GET['new']))
	{
		$sql = "UPDATE card_shop SET state=1 WHERE user_id=(SELECT id FROM users_shop WHERE username='$login')";
		$resultat4 = mysqli_query($db, $sql);
	}
	$sql = "SELECT product_id, amount FROM card_shop_product WHERE card_shop_id=(SELECT id FROM card_shop WHERE user_id=(SELECT id FROM users_shop WHERE username='$login') AND state=0)";
	$resultat = mysqli_query($db, $sql);
	$totalprice = 0;
	?>
	<div id="prodbycat" class="categories">
	<?php
	while ($row = mysqli_fetch_assoc($resultat))
	{
		?>
		<?php
		$prod = $row['product_id'];
		?>
		<div class="productname">Quantité : <?=$row['amount']?></div>
		<?php
		$sql = "SELECT name, price FROM product_shop WHERE id='$prod'";
		$resultat2 = mysqli_query($db, $sql);
		$raw = mysqli_fetch_assoc($resultat2);
		$totalprice += (intval($row['amount'] * intval($raw['price'])));
		?>
		<div class="productname"><?=$raw['name']?>
		</div>
		<div class="productname">Prix unitaire : <?=$raw['price']?></div>
		<?php
	}
	?>
		<div class="productname>">Total : <?=$totalprice?></div><?php
		if ($login != "no_user")
			echo "<a href='cart.php?new=cart'> Valider ma commande</a>";
?>
<input type="button" value="Vider le panier" onclick="window.location.href='cart.php?action=del'">
</div>
</body>
<?php
	include('./footer.php');
?>
</html>
