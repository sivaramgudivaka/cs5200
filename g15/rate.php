<?php
session_start();
require '/lib/custom_query.php';
$u=$_SESSION['uname'];
$uid = get_uid($u);
$r = $_GET['r'];
$m = $_GET['m'];
$q1 = get_rating_by_user($uid, $m);
$res1 = mysqli_fetch_array($q1);
if($res1['UId']==$uid && $res1['MediaId']==$m)
	update_rating($r, $uid, $m);
else
	rate_media($uid, $m, $r);
		$res=get_avg_rating($m);
		$row=mysqli_fetch_array($res);
		echo $row['RTNG'];

?>