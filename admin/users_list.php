<script type="text/javascript">
	function del(id)
	{
		document.location = (document.location+'?action=delete&id='+id);
	}
</script>
<?php
	$users = getusers();
	if($users != NULL)
	{
		foreach($users as $user)
		{
			$shopcard = getcardshop($user["id"]);
			$total = 0;
			?>
			<div class="user">
				<div class="userid"><?=$user["id"]?></div>
				<div class="username"><?=$user["username"]?></div>
				<div class="cart"><p>Cart</p>
				<?php
				if($shopcard != NULL)
				{
					foreach($shopcard as $row)
					{
					?>
						<div class="cartrow">
							<div class="productid"><?=$row["productid"]?></div>
							<div class="productname"><?=$row["productname"]?></div>
							<div class="productprice"><?=$row["price"]?>€</div>
							<div class="productamount"><?=$row["amount"]?></div>
							<div class="subtotal"><?=($row["price"] * $row["amount"])?>€</div>
						</div>
						<?php
						$total = $total + ($row["price"] * $row["amount"]);
					}
				}
					?>
				<div class="total"><?=$total?>€</div>
				</div>
				<?php
				if($_SESSION['loggued_on_user'] != $user["username"])
				{
					?>
					<button class="delbtn" value="del" name="del" onclick="del(<?=$user["id"]?>);">Delete</button>
					<?php
				}
				?>
			</div>
			<?php
		}
	}
	else
	{
		?>
		<p>No user in shop.</p>
		<?php
	}
?>