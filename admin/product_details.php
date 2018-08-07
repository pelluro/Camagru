<?php
if(isset($_POST["form_productid"]))
{
	if($_POST["form_productid"] > 0)
	{
		update_product($_POST["form_productid"],$_POST["form_productname"],$_POST["form_productprice"],$_POST["form_productimg"]);
		update_categories_of_product($_POST["form_productid"],$_POST["form_product_category"]);
	}
	else
	{
		$id = add_produit($_POST["form_productname"],$_POST["form_productprice"],$_POST["form_productimg"],$_POST["form_product_category"]);
		$url = full_path_cleared()."?id=$id";
		header("Location: $url");
	}
}
else if(isset($_GET["action"]) && $_GET["action"] = "delete")
{
	del_product($_GET["id"]);
	$url = full_path_cleared();
	header("Location: $url");
}

$product = getproduct($_GET["id"]);
$categories = getallcategorieswithproduct($_GET["id"]);
?>
<form method="post" action="">
<input type="hidden" name="form_productid" value="<?=$product != NULL ? $product["id"] : -1?>"/>
<div class="productdetail">
	<div class="productid"><?=$product != NULL ? $product["id"] : ""?></div>
	<div class="productname">Name: <input type="textbox" name="form_productname" value="<?=$product != NULL ? $product["name"] : ""?>"/></div>
	<div class="productprice">Price: <input type="textbox" name="form_productprice" value="<?=$product != NULL ? $product["price"] : ""?>"/></div>
	<div class="productimg">Image: <input type="textbox" name="form_productimg" value='<?=$product != NULL ? $product["imglink"] : ""?>'/></div>
	<div class="productcategories">Categories: 
	<?php
	foreach($categories as $category)
	{
		?>
		<div><input type="checkbox" name="form_product_category[]" value=<?=$category["id"]?> <?=$category["isinproduct"]==1?"checked":""?> /><?=$category["name"]?> </div>
		<?php
	}
	?>
	</div>
</div>
<input type="submit" value="Enregistrer"/>
</form>