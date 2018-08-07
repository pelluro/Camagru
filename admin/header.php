<?php
if (!isset($_SESSION['loggued_on_user']) || $_SESSION['loggued_on_user'] !== "root")
	header("location: ../index.php");
?>
<div class="topmenu">
	<a href="../index.php">Accueil Site</a>
	<a href="index.php">Accueil Admin</a>
	<a href="category.php">Cat&eacute;gories</a>
	<a href="product.php">Produits</a>
	<a href="user.php">Utilisateurs</a>
	<a href='../logout.php'>Deconnexion</a>
	<a href='../del_account.php'>Suppression de compte</a>
</div>