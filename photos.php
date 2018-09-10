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
    $likes = $dbConnector->getLikesFromPictureId($picture->getID());
    $userLike = $dbConnector->getUsersFromLikesOfPicture($picture->getID());
    $userConnect = getConnectedUser($dbConnector);
    ?>
    <div class="panel panel-primary">
        <div class="panel-heading"><?=$picture->filename?></div>
        <div class="panel-body" align="center">
                <div class="col-xs-12"><img src="./img/<?= $picture->filename?>"/></div>
                <div class="col-xs-12">
                    <?php
                    $first = 1;
                    $hasLiked = 0;
                    $isLoggedIn = isLoggedIn();
                    $count = 0;
                    $text = "";
                    if($likes != null)
                    {
                        foreach ($likes as $like) {
                            $count++;
                            if (!$first)
                                $text .= ", ";
                            $text .=  $userLike[$like->user_id];
                            if ($first)
                                $first = 0;
                            if ($userConnect != null && $userConnect->getID() == $like->user_id)
                            {
                                $hasLiked = 1;
                            }
                        }
                    }
                    if($userConnect != null) {
                        ?>
                        <form id="formLike" action="business/like.php" method="POST">
                            <input type="hidden" name="pic_id" value="<?= $picture->getID(); ?>"/>
                            <input type="hidden" name="user_id" value="<?= $userConnect->getID(); ?>"/>
                            <?php
                            if ($hasLiked) {
                                ?>
                                <input type="hidden" name="likeNewValue" value="0"/>
                                <input type="submit" class="btn btn-default btn-sm" name="submit" value="Unlike"/>
                                <?php
                            } else {
                                ?>
                                <input type="hidden" name="likeNewValue" value="1"/>
                                <input type="submit" class="btn btn-default btn-sm" name="submit" value="Like"/>
                                <?php
                            }
                            ?>
                        </form>
                        <?php
                    }
                    echo $text;
                    if ($count == 1)
                    {
                        echo " has like";
                    }
                    else if($count > 1)
                    {
                        echo " have like";
                    }
                    ?>
                </div>
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
            if ($userConnect != null)
            {
                ?>
                <form id="formComment" action="business/comments.php" method="POST">
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
