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
	$categories = getcategories();
	if($categories != NULL)
	{
		foreach($categories as $category)
		{
			?>
			<div class="category">
				<div class="categoryid"><?=$category["id"]?></div>
				<div class="categoryname"><?=$category["name"]?></div>
				<button class="editbtn" value="edit" name="edit" onclick="edit(<?=$category["id"]?>);">Edit</button>
				<button class="delbtn" value="del" name="del" onclick="del(<?=$category["id"]?>);">Delete</button>
			</div>
			<?php
		}
	}
	else
	{
		?>
		<p>No category in shop.</p>
		<?php
	}
?>
<button class="addbtn" value="add" name="add" onclick="add();">Create</button>