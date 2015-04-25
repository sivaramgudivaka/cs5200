<html>

<body>
<?php include '/lib/user.php' ;
$uname = $_POST['uname'];
$pwd = $_POST['pwd'];
$uname_check = validate_user($uname, $pwd);
if($uname_check == $uname)
{
	session_start();
	$_SESSION['uname'] = $uname;
	header("location:index.php");
}	
else
	header("location:fail.php");
mysqli_close($con);
 ?>

</body>
</html>