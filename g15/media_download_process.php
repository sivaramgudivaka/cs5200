<?php
session_start();
include 'lib/db_connect.php';
include '/lib/Meta.php';
include '/lib/Dandv.php';
if(!isset($_SESSION['uname']))
	header("Location:index.php");
$uname = $_SESSION['uname'];
$uid = $_SESSION['uid'];
$mediaid = $_GET['m'];

//models
$meta_obj = new meta;
$dandv_obj = new dandv;

//initializations
$meta_obj->__set('mediaid', $mediaid);	

//daos
$meta_dao = new MetaDAO;
$dandv_dao = new DandvDAO;

$result = $meta_dao->get_meta($meta_obj);
$row = mysqli_fetch_array($result);
$path = $row['MediaPath'].$row['MediaName'];

//some parameters for download
header("Content-type: application/force-download");
header("Content-Transfer-Encoding: Binary");
header("Content-disposition: attachment; filename=\"".basename($path)."\"");
readfile($path);


$dandv_obj->__set('uid', $uid);
$dandv_obj->__set('mediaid', $mediaid);
$dandv_obj->__set('type', 'download');
$dandv_dao->add_download($dandv_obj);
?>


