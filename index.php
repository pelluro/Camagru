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