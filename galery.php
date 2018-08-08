<?php
	session_start();
	require_once dirname(__FILE__)."/functions/connection.php";
	require_once dirname(__FILE__)."/admin/functions/functions_products.php";
	require_once dirname(__FILE__)."/admin/functions/functions_categories.php";
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/menu.css">
		<link rel="stylesheet" type="text/css" href="css/categories.css">
		<title>Produits</title>
	</head>
	<body>
	<?php
	include('./header.php');
	?>
	<div class="categories">
		<?php
		if(!isset($_GET['id']))
			$products = getproducts();
		if($products != NULL)
		{
		?>
		<div id="prodbycat"><?php
			foreach($products as $product)
			{
				?>
					<div class="productid"><?=$product['id']?></div>
					<div class="productname"><?=$product['name']?></div>
					<div class="productprice"><?=$product['price']?></div>
					<div class="productimg"><img width="320" height="320" src='<?=$product["imglink"]?>' alt='image'/></div>
					<input type="button" value="Ajouter au panier" onclick="window.location.href='add_to_cart.php?id=<?=$product['id']?>'">
				<?php
			}
		}
		else
		{
			?>
			<p>No product in shop.</p>
			<?php
		}?>
		</div>
	</div>
	</body>
	<?php
		include('./footer.php');
	?>
</html>