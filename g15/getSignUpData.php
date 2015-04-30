<html>

<body>
<?php
include 'lib/db_connect.php';
include '/lib/User.php';
$uname = $_POST['uname'];
$pwd = $_POST['pwd'];
$fname = $_POST['FirstName'];
$lname = $_POST['LastName'];
$mail = $_POST['email'];
$gender = $_POST['gender'];
$dob = $_POST['DOB'];
$role = 'user';
$user_obj= new user;
$user_obj->__set('uname', $uname);
$user_obj->__set('password', $pwd);
$user_obj->__set('fname', $fname);
$user_obj->__set('lname', $lname);
$user_obj->__set('email', $mail);
$user_obj->__set('gender', $gender);
$user_obj->__set('dob', $dob);
$user_obj->__set('role', $role);
$userdao_class= new UserDAO;
$usr_check = $userdao_class->validate_user($user_obj);
if($usr_check!=$uname)
{
	$userdao_class->create_user($user_obj);
	echo "Sign up Successful! Please wait while we redirect you to the main page.";
	if(!isset($_SESSION)){session_start();}
	$_SESSION['uname'] = $uname;
	$_SESSION['uid'] = $userdao_class->get_uid($user_obj);
	header( "refresh:2;url=index.php" );
}
else{
	echo "Username ". $u." exists.";
	echo "click <a href=\"register.php\">here</a> to try a different username.";
}
 ?>
</body>
</html>