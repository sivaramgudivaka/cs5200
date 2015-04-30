<?php
session_start();
include 'lib/db_connect.php';
include '/lib/User.php';
include '/lib/Messages.php';
	$u=$_SESSION['uname'];
	$uid = $_SESSION['uid'];
	$receiver=$_POST['receiver'];
	$msg=isset($_POST['message'])?$_POST['message']:$_GET['message'];
	$usr_obj = new user;
	$usr_obj->__set('uname', $receiver);
	$usr_dao = new UserDAO;
	$query = $usr_dao->get_receiver($usr_obj);
	if(mysqli_num_rows($query)!=0){//if user is a valid youtube+ user
	$messages_obj = new Messages;
	$messages_obj->__set('sender', $uid);
	$messages_obj->__set('receiver', $usr_dao->get_uid($usr_obj));
	$messages_obj->__set('message', $msg);
	$msg_dao = new MessagesDAO;
	$msg_dao->send_message($messages_obj);
	echo "Message sent successfully!.Click <a href=\"createM.php\">here</a> to go back.";
	}
	else
		echo "Invalid Recepient!.Click <a href=\"createM.php\">here</a> to go back and try again";	
?>