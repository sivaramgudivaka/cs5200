<?php
session_start();
require '/lib/custom_query.php';
$u = $_SESSION['uname'];
$uid = get_uid($u);
$m = $_GET['m'];

$result = get_uploader($m);
$row = mysqli_fetch_array($result);
$uploader = $row['UId'];
if($uploader==$uid)
	echo("own");
else
	$res = add_subscription($u, $uploader);
?>