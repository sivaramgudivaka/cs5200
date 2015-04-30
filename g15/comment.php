<?php
session_start();
include '/lib/Comments.php';
include '/lib/db_connect.php';
$con = connect();
$u = $_SESSION['uname'];
$uid = $_SESSION['uid'];
$com=$_GET['q'];
$m=$_GET['m'];
$com=mysqli_real_escape_string($con,$com);
$comment_obj=new Comment;
$comment_obj->__set('uid', $uid);
$comment_obj->__set('mediaid', $m);
$comment_obj->__set('comment', $com);
$comment_dao = new CommentsDAO;
$comment_dao->create_comment($comment_obj);
echo $com;
?>