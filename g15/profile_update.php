<html>
<body>
<?php
session_start();
require '/lib/custom_query.php';
if(!isset($_SESSION['uname']))
	header("Location:signin.php");

$un = $_SESSION['uname'];
$p = $_POST['pwd'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$mail = $_POST['mail'];
$gender = $_POST['gender'];
$dob = $_POST['DOB'];
$test = update_user($fname,$lname,$mail,$p,$gender,$dob,$un);
if($test)
{
	$_SESSION['id']="yes";
	header("location: profile.php");
}
?>
</body>
</html>