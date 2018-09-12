<?php
require_once("../model/DBConnector.php");
session_start();
require_once("../config/database.php");
require_once("../functions/functions.php");
if(!isset($_POST['action']))
{
    registerMessageHeader("Unknown action.", "danger");
    header('location: ../photos.php?id='.$_POST['pic_id']);
}

if($_POST['action'] == "insert" && (!isset($_POST['comment']) || strlen($_POST["comment"])==0))
{
    registerMessageHeader("Empty Comment.", "danger");
    header('location: ../photos.php?id='.$_POST['pic_id']);
}
else if($_POST["action"] == "delete" && !isset($_POST["comment_id"]))
{
    registerMessageHeader("Unknown Comment.", "danger");
    header('location: ../photos.php?id='.$_POST['pic_id']);
}
if(!isLoggedIn())
{
    registerMessageHeader("User not login.", "danger");
    header('location: ../photos.php?id='.$_POST['pic_id']);
}
$user=getConnectedUser($dbConnector);
$pic_id = htmlentities($_POST['pic_id'], ENT_QUOTES, "UTF-8");

if($_POST['action'] == "insert") {
    $content = htmlentities($_POST['comment'], ENT_QUOTES, "UTF-8");
    $comment = new Comment(null);
    $comment->user_id = $user->getID();
    $comment->pic_id = $pic_id;
    $comment->date = date("Y-m-j H:i:s");
    $comment->content = $content;
    $dbConnector->saveComment($comment);
    $picture = $dbConnector->getPicture($pic_id);
    $owner = $dbConnector->getUserByID($picture->user_id);
    $paramOwnerNotifOnComment = $dbConnector->getParamUser($owner->getID(), NOTIF_COMMENT_MYPIC);
    if ($paramOwnerNotifOnComment == null || $paramOwnerNotifOnComment->param_value) {
        mailnotif($owner, $picture, $user);
    }
}
else if($_POST['action'] == 'delete')
{
    $comment_id = $_POST['comment_id'];
    $commentToDelete = $dbConnector->getCommentsById($comment_id);
    $relatedPicture = $dbConnector->getPicture($pic_id);
    if($commentToDelete == null)
    {
        registerMessageHeader("Unknown comment.", "danger");
        header('location: ../photos.php?id='.$_POST['pic_id']);
    }
    if($relatedPicture == null)
    {
        registerMessageHeader("Unknown picture.", "danger");
        header('location: ../gallery.php');
    }
    else if($commentToDelete->user_id != $user->getID() && $relatedPicture->user_id != $user->getID())
    {
        echo "USERIDCOMMENT = ".$commentToDelete->user_id ;
        echo "<br/>USERID = ".$user->getID() ;
        echo "<br/>USERIDPIC = ".$relatedPicture->user_id ;

        registerMessageHeader("Unauthorized.", "danger");
        header('location: ../photos.php?id='.$_POST['pic_id']);
		exit;
    }
    $dbConnector->deleteComment($commentToDelete->getID());
}
registerMessageHeader("OK.", "success");
header("location: ../photos.php?id=$pic_id");
exit;