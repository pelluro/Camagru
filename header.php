<div class="topmenu">
	<a href="index.php">Accueil</a>
	<a href="produit.php">Produits</a>
	<a href="cart.php">Panier</a>
	<a href='categories.php'>Catégories</a>
	<?php
	if (!isset($_SESSION['loggued_on_user']))
	{
		?>
		<a href='login.php'>Se connecter / S'inscrire</a>
		<?php
	}
	else
	{
		?>
		<a href='logout.php'>Deconnexion</a><a href='del_account.php'>Suppression de compte</a>
		<?php
	}
	?>
</div>