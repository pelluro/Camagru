<?php
$user="pelluro";
$pass="pelluro";
try {
    $dbh = new PDO('mysql:host=spacevanas;port=3307;dbname=pelluro', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    foreach($dbh->query('SELECT * from toto') as $row) {
        print_r($row);
    }
    $dbh = null;
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
?>

<html>
<head>
    <title>
        Toto fait camagru
    </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"/>
    <body>
<button class="btn btn-success">Test</button>

ceci est le body
</body>
</head>

</html>
