<html>

<body>
<?php
include 'lib/db_connect.php';
 include '/lib/User.php';
 $uname = $_POST['uname'];
$pwd = $_POST['pwd'];
$user_obj= new user;
$user_obj->__set('uname',$uname);
$user_obj->__set('password',$pwd);
$userdao_class= new UserDAO;

$uname_check = $userdao_class->validate_user($user_obj);
if($uname_check == $uname)
{
	session_start();
	$_SESSION['uname'] = $uname;
	$_SESSION['uid'] = $userdao_class->get_uid($user_obj);	
	header("location:index.php");
}	
else
	header("location:fail.php");
 ?>

</body>
</html>