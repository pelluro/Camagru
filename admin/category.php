<?php
	session_start();
	require_once dirname(__FILE__)."/../functions/connection.php";
	require_once dirname(__FILE__)."/functions/functions_products.php";
	require_once dirname(__FILE__)."/functions/functions_categories.php";
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/menu.css">
	<title>Gestion des catégories - Administration</title>
</head>
<body>
<?php
	include('./header.php');
	?>
	<div id="body">
	<?php
	if(!isset($_GET['id']))
	{
		include('./categories_list.php');
	}
	else
	{
		include('./category_details.php');
	}
	?>
	</div>
</body>
<?php
	include('./footer.php');
?>
</html>