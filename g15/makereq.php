<?php
session_start();

$u=$_SESSION['uname'];
$friend=$_GET['u'];
$res=request_friend($u,$friend);
header("Location:friends.php");
?>
		