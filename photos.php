<?php
if(!isset($_GET["id"]))
{
    header("location: index.php");
}
$titlePage = "Galery Page";
include('./views/header.php');
$picture = $dbConnector->getPicture($_GET["id"]);
if($picture==null)
{
    ?>
    <div class="panel panel-danger">
        <div class="panel-heading">Error</div>
        <div class="panel-body">Picture not found</div>
    </div>
    <?php
}
else {
    ?>
    <div class="panel panel-primary">
        <div class="panel-heading"><?=$picture->filename?></div>
        <div class="panel-body" align="center">
                <img src="./img/<?= $picture->filename?>"/>
        </div>
    </div>
    <?php
    $comments=$dbConnector->getCommentsByPicture($picture->getID());
    ?>
    <div class="panel panel-primary">
        <div class="panel-heading">Comments</div>
        <div class="panel-body">
            <?php
            if ($comments != null)
            {
                foreach ($comments as $comment)
                {
                    echo "{$comment->comment}<br/>";
                }
            }
            ?>
        </div>
    </div>
<?php
}
include('./views/footer.php');
?>
