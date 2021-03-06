<?php
include "include.php";

if( !isset($_POST['user_id']) || !isset($_POST['likeNewValue']))
{
    registerMessageHeader("Empty User or Action.", "danger");
    header('location: ../photos.php?id='.$_POST['pic_id']);
}
$pic_id = htmlentities($_POST['pic_id'], ENT_QUOTES, "UTF-8");
$user_id = htmlentities($_POST['user_id'], ENT_QUOTES, "UTF-8");
$likeNewValue = $_POST['likeNewValue'];
if($likeNewValue == 1)
{
    if(!$dbConnector->hasLiked($pic_id,$user_id))
    {
        $like = new Like(null);
        $like->pic_id = $pic_id;
        $like->user_id = $user_id;
        $dbConnector->saveLike($like);
        registerMessageHeader("Liked.", "success");
    }
}
else
{
    if($dbConnector->hasLiked($pic_id,$user_id)) {
        $dbConnector->deleteLike($pic_id, $user_id);
        registerMessageHeader("Unliked.", "success");
    }
}
header('location: ../photos.php?id='.$_POST['pic_id']);