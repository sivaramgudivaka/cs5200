<?php
session_start();
require '/lib/custom_query.php';
$u=$_SESSION['uname'];
$uid = get_uid($u);
$t=$_GET['t'];
$m=$_GET['m'];
$q1=get_media_for_user($u,$m);
$res1=mysqli_fetch_array($q1);

if($res1['UId']==$uid && $res1['MediaId']==$m)
	$res=update_like($uid,$m,$t);
else
	$res=add_like($uid,$t,$m);

		$row=mysqli_num_rows($res);
		echo $row;
?>