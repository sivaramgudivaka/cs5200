<?php
 
//require 'db_connect.php';
class Messages
{
	private  $messageid;
	private  $sender;
	private  $receiver;
	private  $message;
	private  $time;

	public function __get($property) 
	{
		if (property_exists($this, $property)) 
		{

		  return $this->$property;
		}
	}

    public function __set($property, $value) 
    {
		if (property_exists($this, $property)) 
		{
		  $this->$property = $value;
		}

    }
}  
class MessagesDAO
{	
	public function get_received_messages($messages)
	{   
	    $u = $messages->__get('receiver');
		$con = connect();
		$res = mysqli_query($con,"SELECT * FROM messages WHERE Receiver='$u' ORDER BY Time DESC");
		return $res;
	}

	public function get_sent_messages($messages)
	{	
		$u = $messages->__get('sender');
		$con = connect();
		$res = mysqli_query($con,"SELECT Receiver,Message,Time FROM messages WHERE Sender='$u' ORDER BY Time DESC");
		return $res;
	}
	
	public function send_message($messages)
	{
		$uid = $messages->__get('sender');
		$receiver = $messages->__get('receiver');
		$msg = $messages->__get('message');
		$con = connect();
		mysqli_query($con,"INSERT INTO messages(Sender,Receiver,Message) values ('$uid','$receiver','$msg')");
	}
	
	public function get_message($messages)
	{
		$msgid = $messages->__get('messageid');
		$con = connect();
		$q1 = mysqli_query($con,"SELECT * FROM messages WHERE MessageId = '$msgid'");
		return $q1;
	}		
}
?>