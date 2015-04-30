<?php
session_start();
include '/lib/db_connect.php';
include '/lib/Like.php';
$u=$_SESSION['uname'];
$t=$_GET['t'];
$m=$_GET['m'];

$uid=$_SESSION['uid'];

$like_obj = new like;
$likedao_obj = new LikeDAO;
$like_obj->__set('uid', $uid);
$like_obj->__set('mediaid', $m);
$like_obj->__set('type', $t);

$q1 = $likedao_obj->get_media_for_user($like_obj);
$res1=mysqli_fetch_array($q1);

if($res1['UId']==$uid && $res1['MediaId']==$m)
	$res= $likedao_obj->update_like($like_obj);
else
	$res= $likedao_obj->add_like($like_obj);

		$row=mysqli_num_rows($res);
		echo $row;
?>