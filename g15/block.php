<?php
session_start();
include '/lib/db_connect.php';
include '/lib/Block.php';
$blocker_id = $_SESSION['uid'];
$blckd_id = $_GET['u'];
$bloc = new Block;
$bloc_dao = new BlockDAO;
$bloc->__set('blocked', $blckd_id);
$bloc->__set('blocker', $blocker_id);		
$bloc_dao->block_user($bloc);
header("Location:blocked.php");	
?>
	