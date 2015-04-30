<?php

//validate_user : validates the given uname and pwd
//returns uname if success else errors
class like
{
  private  $likeid;
  private  $uid;
  private  $mediaid;
  private  $type;
  
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
class LikeDAO
{
//update_likes
function update_like($like)
{
	$t = $like->__get('type');
	$m = $like->__get('mediaid');
	$u = $like->__get('uid');
	$con=connect();
	mysqli_query($con,"UPDATE likes SET Type='$t' WHERE UId='$u' AND MediaId='$m' ");
	$res=mysqli_query($con,"SELECT * FROM likes WHERE Type='$t' AND MediaId='$m'");
	return $res;
}

function get_media_for_user($like)
{
	$m = $like->__get('mediaid');
	$u = $like->__get('uid');
	$con=connect();
	$res=mysqli_query($con,"SELECT MediaId,Type,UId FROM likes where UId = '$u' AND MediaId='$m'");
	return $res;
} 

//add likes
function add_like($like)
{
    $t = $like->__get('type');
	$m = $like->__get('mediaid');
	$u = $like->__get('uid');
	$con=connect();
	$query="INSERT INTO likes(UId,MediaId,Type) VALUES ('$u','$m','$t')";
	mysqli_query($con,$query);
	$res=mysqli_query($con,"SELECT * FROM likes WHERE Type='$t' AND MediaId='$m'");
	return $res;
}
//get_likes_per_user: gets likes/dislikes
//likes
function get_likes_per_user($like)
{
	$mid = $like->__get('mediaid');
	$uid =  $like->__get('uid');
	$con = connect();
	$query = mysqli_query($con, "SELECT * FROM likes where UId='$uid' AND MediaId='$mid'");
	return $query;
}

//likes
function get_likes($like)
{
    $type = $like->__get('type');
	$mid = $like->__get('mediaid');
	$con = connect();
	$query = mysqli_query($con,"SELECT * FROM likes WHERE MediaId='$mid' AND Type='$type'");
	return $query;
}
}
?>