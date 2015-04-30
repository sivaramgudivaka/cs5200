<?php

class Friendreq
{
	private  $fid;
	private  $friend;
	private  $reqstat;
	private  $uid;

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
class FriendreqDAO
{	
	public function get_my_friends($friendreq)
	{   
		$con = connect();
		$uid = $friendreq->__get('uid');
		$q1="SELECT * FROM friendreq WHERE UId='$uid' AND reqStat='accepted'";
		$res = mysqli_query($con, $q1);
		return $res;
	}
	
	public function get_their_friends($friendreq)
	{   
		$con = connect();
		$uid = $friendreq->__get('uid');
		$q1="SELECT * FROM friendreq WHERE friend='$uid' AND reqStat='accepted'";
		$res = mysqli_query($con, $q1);
		return $res;
	}
	
	
	
	public function request_friend($friendreq)
	{
		$con=connect();
		$u = $friendreq->__get('uid');
		$friend = $friendreq->__get('friend');
		$reqstat = $friendreq->__get('reqstat');
		$q1="INSERT INTO friendreq(UId,friend,reqStat) VALUES ('$u', '$friend','$reqstat')";
		mysqli_query($con,$q1);
	}
	public function pending_reqs($friendreq)
	{
		$uid = $friendreq->__get('uid');
		$con = connect();
		$res=mysqli_query($con,"SELECT * FROM friendreq WHERE friend='$uid' AND reqStat='pending'");
		return $res;
	}

	public function respond_to_friend_req($friendreq)
	{
		$con = connect();
		$uid = $friendreq->__get('uid');
		$friend = $friendreq->__get('friend');
		$reqstat = $friendreq->__get('reqstat');
		$q1="UPDATE friendreq SET reqStat='$reqstat' WHERE UId='$uid' AND friend='$friend' ";
		$res=mysqli_query($con,$q1);
	}
}
?>