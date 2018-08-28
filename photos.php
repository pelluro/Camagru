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
    $usersByID = $dbConnector->getUsersFromCommentsOfPicture($picture->getID());
    ?>
    <div class="panel panel-primary">
        <div class="panel-heading">Comments</div>
        <div class="panel-body">
            <table class="table">
                <tr><th width="20%">Who</th><th width="80%">Comment</th></tr>
            <?php
            if ($comments != null)
            {
                foreach ($comments as $comment)
                {
                    ?>
                    <tr><td><div><b><?=$usersByID[$comment->user_id]->login?></b></div><div><i><?=$comment->date?></i></div></td><td><?=$comment->content?></td></tr>
                    <?php
                }
            }
            ?>
            </table>
            <?php
            if (isLoggedIn())
            {?>
                <form id="form" action="business/comments.php" method="POST">
                    <input type="text" id="" size="60" name="comment" autocomplete="off" value="" autofocus="autofocus" placeholder="Comment here !"/>
                    <input type="hidden" name="pic_id" value="<?=$picture->getID();?>"/>
                    <input id="reset" type="submit" name="submit" value="Submit">
                </form>
            <?php
            }
            ?>
        </div>
    </div>
<?php
}
include('./views/footer.php');
?>
