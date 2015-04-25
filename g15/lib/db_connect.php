<?php
//db_connect functions

//connect: connects to the DB with the db Uname and Pwd
function connect()
{
	$con = mysqli_connect('localhost', 'root', '', 'g15');
	if (mysqli_connect_errno())
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	else
		return $con;
}
?>