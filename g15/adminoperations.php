<?php
session_start();
include 'lib/db_connect.php';
require '/lib/User.php';
if(!isset($_SESSION['uname']))
	header("Location:signin.php");
$usr_obj = new user;
$uname = $_SESSION['uname'];
$uid = $_SESSION['uid'];
$usr_obj->__set('uid', $uid);
$user_dao = new UserDAO;
$res = $user_dao->retrieve_user($usr_obj);
$row = mysqli_fetch_array($res);
$my_role = $row['Role'];
if($my_role!="admin")
	header("Location:index.php");
$op = $_GET['op'];
$victim = $_GET['uid'];
$usr_obj->__set('uid', $victim);
if($op=='dem')
{
	$usr_obj->__set('role', 'user');
	$user_dao->update_role($usr_obj);
}
else if($op=='pro')
{
	$usr_obj->__set('role', 'admin');
	$user_dao->update_role($usr_obj);
}

else
	$user_dao->delete_user($usr_obj);
header("Location:admin.php");
	

	
?>