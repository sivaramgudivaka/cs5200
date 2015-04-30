<?php
 
//require 'db_connect.php';
class Block
{
	private  $blocked;
	private  $blocker;
	private  $blockid;

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
class BlockDAO
{	
	//retrieve_blocked: retrieves blocked people
	public function retrieve_blocked($bloc)
	{
		$blocked = $bloc->__get('blocked');
		$blocker = $bloc->__get('blocker');
		$con = connect();
		$query = mysqli_query($con,"SELECT Blocked FROM block WHERE Blocked='$blocked' AND Blocker='$blocker'");
		return $query;
	}
	//block_user : for user blocking
	public function block_user($bloc)
	{
	   $blocked = $bloc->__get('blocked');
	   $blocker = $bloc->__get('blocker');
	   $con=connect();
	   mysqli_query($con,"INSERT INTO block (BlockId,Blocker,Blocked) VALUES (NULL,'$blocker','$blocked')" );
	}
}
?>