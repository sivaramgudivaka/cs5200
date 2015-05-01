<?php

//include 'db_connect.php';
//validate_user : validates the given uname and pwd
//returns uname if success else errors
class user
{
  private  $uid;
  private  $lname;
  private  $fname;
  private  $uname;
  private  $password;
  private  $email;
  private  $gender;
  private  $dob;
  private  $role;  

  public function __get($property) {
    if (property_exists($this, $property)) {
      return $this->$property;
    }
  }

  public function __set($property, $value) {
    if (property_exists($this, $property)) {
      $this->$property = $value;
    }

  }
}  
  

class UserDAO
{
public function validate_user($user)
{
    
    $username=$user->__get('uname');
	$password=$user->__get('password');
	$con = connect();
	$result = mysqli_query($con, "SELECT * FROM user WHERE Uname='$username' AND Password='$password' ");
	$num_rows = mysqli_num_rows($result);
	if ($num_rows == 0)
		return "Invalid Login";
	else
		return $username;
}

//create_user : creates a new user in youtube++
public function create_user($user)
{	
	  $uname=$user->__get('uname');
	//echo $username;
	  $pwd=$user->__get('password');
	  $fname=$user->__get('fname');
	  $lname=$user->__get('lname');
	  $mail=$user->__get('email');
	  $gender=$user->__get('gender');
	  $role=$user->__get('role');
	  $dob=$user->__get('dob');
	$con = connect();
	mysqli_query($con, "INSERT INTO user VALUES(NULL,'$fname','$lname','$uname','$pwd','$mail','$gender',STR_TO_DATE('$dob','%m/%d/%Y'),'$role')");
}

//retrieve_user : retrieves a new user in youtube++
public function retrieve_user($user)
{		
    $uid=$user->__get('uid');
	$con = connect();
	$q1 = mysqli_query($con, "SELECT * FROM user WHERE UId = '$uid'");
	return $q1;
}

//get_uid : retrieves a new user in youtube++
public function get_uid($user)
{		
	$uname = $user->__get('uname');
	$con = connect();
	$q1 = mysqli_query($con, "SELECT * FROM user WHERE Uname = '$uname'");
	$res = mysqli_fetch_array($q1);
	$uid= $res['UId'];
	return $uid;
}

//get_uname : retrieves a new user in youtube++
public function get_uname($user)
{		
    $uid = $user->__get('uid');
	$con = connect();
	$q1 = mysqli_query($con, "SELECT * FROM user WHERE UId = '$uid'");
	$res = mysqli_fetch_array($q1);
	$uname = $res['Uname'];
	return $uname;
}

//updates user
public function update_user($user)
{
	$un=$user->__get('uname');
	//echo $username;
	$p=$user->__get('password');
	$fname=$user->__get('fname');
	$lname=$user->__get('lname');
	$mail=$user->__get('email');
	$gender=$user->__get('gender');
	$dob=$user->__get('dob');
	$con=connect();
	$res=mysqli_query($con,"UPDATE user SET FirstName='$fname', LastName='$lname', Email='$mail', Password='$p', Gender='$gender', DOB=STR_TO_DATE('$dob','%m/%d/%Y') WHERE Uname='$un' ");
	return $res;
}
//get_user
function get_receiver($user)
{
	$u=$user->__get('uname');
	$con=connect();
	$res=mysqli_query($con,"SELECT * FROM user WHERE Uname='$u' ");	
	return $res;
}
//gets all the users except this user.
function get_all_but_not_this_user($usr)
{
    $user=$usr->__get('uid');
    $con = connect();
	$q1=mysqli_query($con,"SELECT * FROM user WHERE UId != '$user'");
	return $q1;
}

function retrieve_blocked_user($usr)
{
	$uid=$usr->__get('uid');
	$con = connect();
	$res=mysqli_query($con,"SELECT Blocked FROM block WHERE Blocker='$uid'");
	return $res;
}

//user
function get_blocked_users($usr)
{
	$user=$usr->__get('uid');
    $con = connect();
	$q1=mysqli_query($con,"SELECT UId FROM user WHERE NOT UId IN (SELECT Blocked FROM block WHERE Blocker='$user')
					 AND NOT UId='$user'");
	return $q1;
}

public function delete_user($user)
{		
    $uid=$user->__get('uid');
	$con = connect();
	$q1 = mysqli_query($con, "DELETE FROM user WHERE UId = '$uid'");
	return $q1;
}

public function update_role($user)
{
	$uid=$user->__get('uid');
	$role=$user->__get('role');
	$con = connect();
	mysqli_query($con, "UPDATE user SET Role='$role' WHERE UId = '$uid'");
}

}
?>
