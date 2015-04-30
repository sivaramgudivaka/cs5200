<?php
session_start();
include '/lib/db_connect.php';
include '/lib/Media.php';
include '/lib/Subscriptions.php';
$u = $_SESSION['uname'];
$uid = $_SESSION['uid'];
$m = $_GET['m'];
$media_obj=new media;
$media_obj->__set('mediaid',$m);
$mediadao=new MediaDAO;
$result = $mediadao->get_uploader($media_obj);
$row = mysqli_fetch_array($result);
$uploader = $row['UId'];
if($uploader==$uid)
	echo "own";
else
{
	$subscriptions_ob = new Subscriptions;
	$subscriptions_ob->__set('subscriber',$uid);
	$subscriptions_ob->__set('subscribedto',$uploader);
	$subscriptionsdao = new SubscriptionsDAO;
	$subscriptionsdao->add_subscription($subscriptions_ob);
}	
?>