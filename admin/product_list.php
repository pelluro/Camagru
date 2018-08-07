<script type="text/javascript">
	function edit(id)
	{
		document.location = document.location+'?id='+id;
	}
	
	function del(id)
	{
		document.location = (document.location+'?action=delete&id='+id);
	}
	
	function add()
	{
		document.location = document.location+'?id=-1';
	}
</script>
<?php
	$products = getproducts();
	if($products != NULL)
	{
		foreach($products as $product)
		{
			?>
			<div class="product">
				<div class="productid"><?=$product["id"]?></div>
				<div class="productname"><?=$product["name"]?></div>
				<div class="productprice"><?=$product["price"]?></div>
				<div class="productimg"><img width="320" height="320" src='<?=$product["imglink"]?>' alt='image'/></div>
				<button class="editbtn" value="edit" name="edit" onclick="edit(<?=$product["id"]?>);">Edit</button>
				<button class="delbtn" value="del" name="del" onclick="del(<?=$product["id"]?>);">Delete</button>
			</div>
			<?php
		}
	}
	else
	{
		?>
		<p>No product in shop.</p>
		<?php
	}
?>
<button class="addbtn" value="add" name="add" onclick="add();">Create</button>