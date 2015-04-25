<?php
session_start();
require '/lib/custom_query.php';
	$u=$_SESSION['uname'];
	$uid = get_uid($u);
	$receiver=$_POST['receiver'];
	$msg=isset($_POST['message'])?$_POST['message']:$_GET['message'];
	$query=get_receiver($u);
	$row=mysqli_fetch_array($query);
	if($row['Uname']==$receiver){//if user is a valid youtube+ user
	send_message($uid, get_uid($receiver), $msg);
	echo "Message sent successfully!.Click <a href=\"createM.php\">here</a> to go back.";
	}
	else
		echo "Invalid Recepient!.Click <a href=\"createM.php\">here</a> to go back and try again";	
?>