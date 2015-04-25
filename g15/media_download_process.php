<?php
session_start();
require '/lib/custom_query.php';
if(!isset($_SESSION['uname']))
	header("Location:index.php");
$u=$_SESSION['uname'];
$m=$_GET['m'];
$res=retrieve_meta_by_id($m);
$row=mysqli_fetch_array($res);
$path=$row['MediaPath'].$row['MediaName'];
header("Content-type: application/force-download");
header("Content-Transfer-Encoding: Binary");
header("Content-disposition: attachment; filename=\"".basename($path)."\"");
readfile($path);
$add_downloads=add_download($u,$m);
?>


