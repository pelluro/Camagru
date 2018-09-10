<?php
require_once("../model/DBConnector.php");
session_start();
require_once("../config/database.php");
require_once("../functions/functions.php");

if( !isset($_POST['comment']) || strlen($_POST["comment"])==0)
{
    registerMessageHeader("Empty Comment.", "danger");
    header('location: ../photos.php?id='.$_POST['pic_id']);
}
$content = htmlentities($_POST['comment'], ENT_QUOTES, "UTF-8");
$pic_id = htmlentities($_POST['pic_id'], ENT_QUOTES, "UTF-8");
if( !isLoggedIn())
{
    registerMessageHeader("Users not login.", "danger");
    header('location: ../photos.php');
}
$user=getConnectedUser($dbConnector);
$comment= new Comment(null);
$comment->user_id = $user->getID();
$comment->pic_id = $pic_id;
$comment->date =date("Y-m-j H:i:s");
$comment->content = $content;
$dbConnector->saveComment($comment);
$picture = $dbConnector->getPicture($pic_id);
$owner = $dbConnector->getUserByID($picture->user_id);
$paramOwnerNotifOnComment = $dbConnector->getParamUser($owner->getID(),NOTIF_COMMENT_MYPIC);
if($paramOwnerNotifOnComment == null || $paramOwnerNotifOnComment->param_value)
{
    mailnotif($owner,$picture,$user);
}
registerMessageHeader("OK.", "success");
header("location: ../photos.php?id=$pic_id");
?>