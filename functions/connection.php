<?php
require_once dirname(__FILE__)."/mysql_logins.php";
$dbname = "boutiques";
$db = mysqli_connect(NULL, $logindb, $passworddb, $dbname,0,'/Users/mipham/Desktop/mamp/mysql/tmp/mysql.sock');

if (mysqli_connect_errno())
{
    echo 'Failed to connect to MySQL:' . mysqli_connect_error();
    exit;
}
?>