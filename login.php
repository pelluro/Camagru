<?php
require_once dirname(__FILE__)."/functions/connection.php";
require_once dirname(__FILE__)."/functions/functions_login.php";
session_start();
if (isset($_POST['submit']))
{
	if (!isset($_SESSION['loggued_on_user']) && check_existing_login($_POST['login']) && check_matching_psswd($_POST['login'], hash("whirlpool", $_POST['psswd'])))
	{
		$_SESSION['loggued_on_user'] = $_POST['login'];
		global $db;
		$sql = "SELECT id FROM card_shop WHERE user_id='1'";
		$result = mysqli_query($db, $sql);
		$row = mysqli_fetch_array($result);
		if ($row[0])
		{
			$login = mysqli_real_escape_string($db, $_SESSION['loggued_on_user']);
			$id = intval($row['id']);
			$sql = "UPDATE card_shop SET user_id=(SELECT id FROM users_shop WHERE username='$login') WHERE user_id='1'";
			mysqli_query($db, $sql);
		}
		header("location: index.php");
	}
	elseif (!isset($_SESSION['loggued_on_user']) && check_existing_login($_POST['login']))
		header("location: login.php?wrong=password");
	else
	{
		add_user($_POST['login'], hash("whirlpool", $_POST['psswd']));
		$_SESSION['loggued_on_user'] = $_POST['login'];
		header("location: login.php?account=created");
	}
}
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/menu.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<title>Compte</title>
</head>
<body>
	<?php
	include('./header.php');
	if (isset($_GET['wrong']))
		echo "<p id='wrongpasswd'>Compte existant, erreur de mot de passe</p>";
	else if (!isset($_SESSION['loggued_on_user']))
		echo "<form class='loginform' action='' method='post'>Veuillez renseigner un identifiant et un mot de passe. Si l'identifiant n'existe pas, un compte sera créé.<br /><br />Identifiant: <input type='text' name='login' required/><br />Mot de passe: <input type='password'  name='psswd' required/><br /><input type='submit' name='submit' value='Envoyer'></form>";
	else if (isset($_GET['account']))
	{
		echo "<p id='wrongpasswd'>Compte créé</p>";
		global $db;
		$sql = "SELECT id FROM card_shop WHERE user_id='1'";
		$result = mysqli_query($db, $sql);
		$row = mysqli_fetch_array($result);
		if ($row[0])
		{
			$login = $_SESSION['loggued_on_user'];
			$id = intval($row['id']);
			$sql = "UPDATE card_shop SET user_id=(SELECT id FROM users_shop WHERE username='$login') WHERE user_id='1'";
			mysqli_query($db, $sql);
		}
	}
	?>
</body>
<?php
	include('./footer.php');
?>
</html>