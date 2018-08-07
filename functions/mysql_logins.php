<?php
$logindb = "root";
$passworddb = "toto1234";

function check_query($db, $insert)
{
    if (!mysqli_query($db, $insert))
        die("Error description: " . mysqli_error($db));
}
?>