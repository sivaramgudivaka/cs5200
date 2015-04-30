<?php
session_start();
include '/lib/db_connect.php';
include '/lib/Rating.php';
$u = $_SESSION['uname'];
$uid = $_SESSION['uid'];
$r = $_GET['r'];
$m = $_GET['m'];
$rating_obj=new rating;
$rating_obj->__set('uid',$uid);
$rating_obj->__set('mediaid',$m);
$rating_obj->__set('rating',$r);
$ratingdao_obj=new RatingDAO;
$q1 = $ratingdao_obj->get_rating_by_user($rating_obj);
$res1 = mysqli_fetch_array($q1);
if($res1['UId']==$uid && $res1['MediaId']==$m)
	$ratingdao_obj->update_rating($rating_obj);
else
	$ratingdao_obj->rate_media($rating_obj);
		$res=$ratingdao_obj->get_avg_rating($rating_obj);
		$row=mysqli_fetch_array($res);
		echo $row['RTNG'];

?>