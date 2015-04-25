<?php

require 'db_connect.php';
//validate_user : validates the given uname and pwd
//returns uname if success else errors
function validate_user($username, $password)
{
	$con = connect();
	$result = mysqli_query($con, "SELECT * FROM user WHERE Uname='$username' AND Password='$password' ");
	$num_rows = mysqli_num_rows($result);
	if ($num_rows == 0)
		return "Invalid Login";
	else
		return $username;
}

//create_user : creates a new user in youtube++
function create_user($fname, $lname, $uname , $pwd, $mail, $gender, $dob, $role)
{		
	$con = connect();
	mysqli_query($con, "INSERT INTO user VALUES(NULL,'$fname','$lname','$uname','$pwd','$mail','$gender',STR_TO_DATE('$dob','%m/%d/%Y'),'$role')");
	echo "Sign up Successful!";
	echo "click <a href=\"index.php\">here</a>to go to home page.";
}

//retrieve_user : retrieves a new user in youtube++
function retrieve_user($uid)
{		
	$con = connect();
	$q1 = mysqli_query($con, "SELECT * FROM user WHERE UId = '$uid'");
	return $q1;
}

//get_uid : retrieves a new user in youtube++
function get_uid($uname)
{		
	$con = connect();
	$q1 = mysqli_query($con, "SELECT * FROM user WHERE Uname = '$uname'");
	$res = mysqli_fetch_array($q1);
	$uid= $res['UId'];
	return $uid;
}

//get_uname : retrieves a new user in youtube++
function get_uname($uid)
{		
	$con = connect();
	$q1 = mysqli_query($con, "SELECT * FROM user WHERE UId = '$uid'");
	$res = mysqli_fetch_array($q1);
	$uname = $res['Uname'];
	return $uname;
}

function update_user($fname,$lname,$mail,$p,$gender,$dob,$un)
{
	$con=connect();
	$res=mysqli_query($con,"UPDATE user SET FirstName='$fname', LastName='$lname', Email='$mail', Password='$p', Gender='$gender', DOB=STR_TO_DATE('$dob','%m/%d/%Y') WHERE Uname='$un' ");
	return $res;
}

?>
