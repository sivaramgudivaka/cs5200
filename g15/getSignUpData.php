<html>

<body>
<?php require '/lib/user.php';
$uname = $_POST['uname'];
$pwd = $_POST['pwd'];
$fname = $_POST["FirstName"];
$lname = $_POST["LastName"];
$mail = $_POST["email"];
$gender = $_POST['gender'];
$dob = $_POST['DOB'];
$role = 'user';
$usr_check = validate_user($uname, $pwd);
if($usr_check!=$uname)
	create_user($fname, $lname, $uname , $pwd, $mail, $gender, $dob, $role);
else{
	echo "Username ". $u." exists.";
	echo "click <a href=\"register.php\">here</a> to try a different username.";
}
 ?>
</body>
</html>