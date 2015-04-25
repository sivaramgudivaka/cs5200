<?php
session_start();
require '/lib/custom_query.php';
$u=$_SESSION['uname'];
$uid = get_uid($u);
$friend=$_GET['f'];
$accept=$_GET['a'];
if($accept=="y")
	respond_to_friend_req($uid, $friend, 'accepted');
else
	respond_to_friend_req($uid, $friend, 'rejected');
header("Location:friends.php");
?>
		