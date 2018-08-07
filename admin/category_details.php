<?php
if(isset($_POST["form_categoryid"]))
{
	if($_POST["form_categoryid"] > 0)
	{
		update_category($_POST["form_categoryid"],$_POST["form_categoryname"],$_POST["form_categoryprice"],$_POST["form_categoryimg"]);
	}
	else
	{
		$id = add_category($_POST["form_categoryname"]);
		$url = full_path_cleared()."?id=$id";
		header("Location: $url");
	}
}
else if(isset($_GET["action"]) && $_GET["action"] = "delete")
{
	del_category($_GET["id"]);
	$url = full_path_cleared();
	header("Location: $url");
}

$category = getcategory($_GET["id"]);
?>
<form method="post" action="">
<input type="hidden" name="form_categoryid" value="<?=$category != NULL ? $category["id"] : -1?>"/>
<div class="categorydetail">
	<div class="categoryid"><?=$category != NULL ? $category["id"] : ""?></div>
	<div class="categoryname">Name: <input type="textbox" name="form_categoryname" value="<?=$category != NULL ? $category["name"] : ""?>"/></div>
</div>
<input type="submit" value="Enregistrer"/>
</form>