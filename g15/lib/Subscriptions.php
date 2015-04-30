<?php
 
//require 'db_connect.php';
class Subscriptions
{
	private  $subid;
	private  $subscribedto;
	private  $subscriber;

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
class SubscriptionsDAO
{	
	//get_subscriptions
	public function get_subscriptions($subscriptions)
	{
		$subscr = $subscriptions->__get('subscriber');
		$subto = $subscriptions->__get('subscribedto');
		$con = connect();
		$query = mysqli_query($con,"SELECT Subscriber FROM subscriptions WHERE Subscriber='$subscr' AND SubscribedTo='$subto'");
		return $query;
	}
	public function channels_subscribed_by_user($subscriptions)
	{
		$u = $subscriptions->__get('subscriber');
		$con = connect();
		$res = mysqli_query($con,"SELECT SubscribedTo FROM subscriptions WHERE Subscriber='$u'");
		return $res;
	}
	public function channels_subscribed_for_user($subscriptions)
	{
		$u = $subscriptions->__get('subscribedto');
		$con = connect();
		$res = mysqli_query($con,"SELECT Subscriber FROM subscriptions WHERE SubscribedTo='$u'");
		return $res;
	}
	public function add_subscription($subscriptions)
	{
		$from = $subscriptions->__get('subscriber');
		$to = $subscriptions->__get('subscribedto');
		$con=connect();
		mysqli_query($con,"INSERT INTO subscriptions(Subscriber,SubscribedTo) values ('$from','$to')");
	}
}
?>