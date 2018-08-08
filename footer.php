<footer>
	<div class="footer">
		<?php
		if (isset($_SESSION['loggued_on_user']))
		{
			?>
			<a href="admin/index.php">Administration</a>
			<?php
		}
		?>
		<p>Myshop</p>
		<p id="copyright">&#169; mipham 2018</p>
	</div>
	<br />
</footer>