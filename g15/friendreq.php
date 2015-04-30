<?php
session_start();
include 'lib/db_connect.php';
include '/lib/Friendreq.php';
$u = $_SESSION['uname'];
$uid = $_SESSION['uid'];
$sender=$_GET['from'];
$reqstat=$_GET['a'];
$friend_obj = new Friendreq;
$friend_obj->__set('uid', $sender);
$friend_obj->__set('friend', $uid);
$friend_obj->__set('reqstat', $reqstat);
$friendreq_dao = new FriendreqDAO;
$friendreq_dao->respond_to_friend_req($friend_obj);
header("Location:friends.php");
?>
		