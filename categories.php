<?php
	session_start();
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/menu.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<link rel="stylesheet" type="text/css" href="css/categories.css">
	<title>Categories</title>
</head>
<body>
	<?php
		include('./header.php');
	?>
	<div class="categories">
		<?php
		require_once dirname(__FILE__)."/functions/connection.php";
		if (!isset($_GET['cat']))
		{
			global $db;
			$sql = "SELECT * FROM category_shop";
			$result = mysqli_query($db, $sql);
			while ($row = mysqli_fetch_array($result))
				echo "<a href='categories.php?cat=$row[1]'>$row[1]</a><br />";
		}
		else
		{
			global $db;
			$cat = mysqli_real_escape_string($db, $_GET['cat']);
			$sql = "SELECT * FROM category_shop WHERE name='$cat'";
			$result = mysqli_query($db, $sql);
			$row = mysqli_fetch_array($result);
			(int)$cat = $row[0];
			$sql = "SELECT name,price,imglink FROM product_shop WHERE id IN (SELECT product_id FROM categories_product WHERE category_id = '$cat')";
			$result = mysqli_query($db, $sql);?>
			<div id="prodbycat"><?php
			while ($row = mysqli_fetch_array($result))
			{
				?>
					<div class='productname'><?="Nom du produit : ".$row['name']?></div>
					<div class='productprice'><?="Prix : ".$row['price']?></div>
					<div class='productimg'><img width='320' height='320' src='<?=$row['imglink']?>' alt='image'/><input type="button" value="Ajouter au panier" onclick="window.location.href='add_to_cart.php?id=<?=$product['id']?>'">
				<?php
			}
			?>
			</div>
			<?php
		}
		?>
	</div>
</body>
<?php
	include('./footer.php');
?>
</html>