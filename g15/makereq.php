<?php
session_start();
include 'lib/db_connect.php';
include '/lib/Friendreq.php';
$uname = $_SESSION['uname'];
$uid = $_SESSION['uid'];
$friend=$_GET['uid'];
$friendreq = new friendreq;
$friendreq->__set('uid',$uid);
$friendreq->__set('friend',$friend);
$friendreq->__set('reqstat','pending');
$friendreq_dao = new FriendreqDAO;
$friendreq_dao->request_friend($friendreq);
header("Location:friends.php");
?>
		