<?php
$titlePage = "approuve";
include('./views/header.php');

if (!$_GET['login'] || !$_GET['confirmation_code'] || !$_GET['email'])
    header('location: index.php');
else
{
    $code=$_GET['confirmation_code'];
    $req = "SELECT * FROM comments WHERE com_confirmation_code='?' ";
    $query = $dbConnection->prepare($req);
    $query->execute( array($code));
    if ($query->rowCount() == 1)
    {
        $req = "UPDATE comments SET active='1' WHERE com_confirmation_code='?' ";
        $query = $bdd->prepare($req);
        $result = $query->execute( array($code));
        if ($result)
        {
            header('location: photos.php');
        }
        else
            echo "<p>Sorry, there has been a <prob></prob>lem approving this comment. Please contact admin.</p>";
    }
    else
        header('location: index.php');
    $query->closeCursor();
}


include('./footer.php');
?>
