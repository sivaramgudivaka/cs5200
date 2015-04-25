<?php
session_start();
require '/lib/custom_query.php';
$u = $_SESSION['uname'];
$uid = get_uid($u);
$m = $_GET['m'];
$pname = $_GET['p'];
$result = get_playlist_by_name($pname, $uid);
$pid = mysqli_fetch_array($result);
$pid = $pid['PId'];
$result = insert_into_playlist($pid, $m);
$row = mysqli_fetch_array($result);
$SubscribedTo = $row['Uname'];
	add_subscription($uid,$SubscribedTo);
?>