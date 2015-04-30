<html>
<body>
<?php
session_start();
include 'lib/db_connect.php';
include '/lib/User.php';
if(!isset($_SESSION['uname']))
	header("Location:signin.php");

$un = $_SESSION['uname'];
$p = $_POST['pwd'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$mail = $_POST['mail'];
$gender = $_POST['gender'];
$dob = $_POST['DOB'];
$user_obj= new user;
$user_obj->__set('uname',$un);
$user_obj->__get('password',$p);
$user_obj->__get('fname',$fname);
$user_obj->__get('lname',$lname);
$user_obj->__get('email',$mail);
$user_obj->__get('gender',$gender);
$user_obj->__get('dob',$dob);
$userdao_obj= new UserDAO;
$test = $userdao_obj->update_user($user_obj);
if($test)
{
	$_SESSION['id']="yes";
	header("location: profile.php");
}
?>
</body>
</html>