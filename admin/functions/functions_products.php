<?php
require_once dirname(__FILE__)."/../../functions/functions.php";

function add_produit($nom, $prix, $imglink, $categories)
{
	global $db;
	$nom = mysqli_real_escape_string($db, $nom);
	$imglink = mysqli_real_escape_string($db, $imglink);
	$prix = floatval($prix);
	$sql = "INSERT INTO product_shop (name, price, imglink) VALUES ('$nom', '$prix', '$imglink')";
	if (!mysqli_query($db, $sql))
	    die("Error: " . $sql . "<br>Stacktrace :" . mysqli_error($db));
	$id = mysqli_insert_id($db);
	$sql = "INSERT INTO categories_product (category_id, product_id) ";
	$first = 1;
	foreach($categories as $category)
	{
		$sql = $sql.($first==1?"VALUES ":",")."(".mysqli_real_escape_string($db, $category).", $id)";
		$first = 0;
	}
	$sql = $sql.";";
	if (!mysqli_query($db, $sql))
	    die("Error: " . $sql . "<br>Stacktrace :" . mysqli_error($db));
	return $id;
}

function del_product($product_id)
{
	global $db;
	$product_id = intval($product_id);
	$sql = "DELETE FROM categories_product WHERE product_id = $product_id";
	if (!mysqli_query($db, $sql))
	    die("Error: " . $sql . "<br>Stacktrace :" . mysqli_error($db));
	$sql = "DELETE FROM card_shop_product WHERE product_id = $product_id";
	if (!mysqli_query($db, $sql))
	    die("Error: " . $sql . "<br>Stacktrace :" . mysqli_error($db));
	$sql = "DELETE FROM product_shop WHERE id = $product_id";
	if (!mysqli_query($db, $sql))
	    die("Error: " . $sql . "<br>Stacktrace :" . mysqli_error($db));
}

function update_product($product_id, $nom, $prix, $imglink)
{
	global $db;
	$product_id = intval($product_id);
	$nom = mysqli_real_escape_string($db, $nom);
	$imglink = mysqli_real_escape_string($db, $imglink);
	$prix = floatval($prix);
	$sql = "UPDATE product_shop SET name = '$nom', price = $prix, imglink = '$imglink' WHERE id = $product_id";
	if (!mysqli_query($db, $sql))
	    die("Error: " . $sql . "<br>Stacktrace :" . mysqli_error($db));
}

function update_categories_of_product($product_id, $categories)
{
	global $db;
	$product_id = intval($product_id);
	$sql = "DELETE FROM categories_product WHERE product_id = $product_id;";
	mysqli_query($db, $sql);
	$sql = "INSERT INTO categories_product (category_id, product_id) ";
	$first = 1;
	foreach($categories as $category)
	{
		$sql = $sql.($first==1?"VALUES ":",")."(".mysqli_real_escape_string($db, $category).", $product_id)";
		$first = 0;
	}
	$sql = $sql.";";
	if (!mysqli_query($db, $sql))
	    die("Error: " . $sql . "<br>Stacktrace :" . mysqli_error($db));
}

function del_categories_of_product($product_id, $categories)
{
	global $db;
	$product_id = intval($product_id);
	$sql = "";
	foreach($categories as $category)
	{
		$sql = $sql."DELETE FROM categories_product WHERE category_id=".mysqli_real_escape_string($db, $category)." and product_id = $product_id;";
	}
	if (!mysqli_query($db, $sql))
	    die("Error: " . $sql . "<br>Stacktrace :" . mysqli_error($db));
}

function getproducts()
{
	global $db;
	$sql = "SELECT product_shop.id, product_shop.name, product_shop.price, product_shop.imglink from product_shop";
	$resultat;
	$res = mysqli_query($db, $sql);
	while ($row = mysqli_fetch_assoc($res))
		$resultat[] = $row;
	return $resultat;
}

function getproduct($product_id)
{
	global $db;
	$product_id = intval($product_id);
	$sql = "SELECT product_shop.id, product_shop.name, product_shop.price, product_shop.imglink from product_shop WHERE product_shop.id = $product_id";
	$resultat;
	$res = mysqli_query($db, $sql);
	return mysqli_fetch_assoc($res);
}

function getcategoriesofproduct($product_id)
{
	global $db;
	$product_id = intval($product_id);
	$sql = "SELECT category_shop.id, category_shop.name from categories_product JOIN category_shop on category_shop.id = categories_product.category_id WHERE categories_product.product_id = $product_id";
	$resultat;
	$res = mysqli_query($db, $sql);
	while ($row = mysqli_fetch_assoc($res))
		$resultat[] = $row;
	return $resultat;
}

function getallcategorieswithproduct($product_id)
{
	global $db;
	$product_id = intval($product_id);
	$sql = "SELECT category_shop.id, category_shop.name,IF(categories_product.product_id IS NULL,0,1) as isinproduct 
	from category_shop 
	LEFT JOIN categories_product on (categories_product.category_id = category_shop.id and categories_product.product_id = $product_id)";
	$resultat;
	$res = mysqli_query($db, $sql);
	while ($row = mysqli_fetch_assoc($res))
		$resultat[] = $row;
	return $resultat;
}
?>