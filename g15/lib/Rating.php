<?php

//require 'db_connect.php';
//validate_user : validates the given uname and pwd
//returns uname if success else errors
class rating
{
  private  $rid;
  private  $uid;
  private  $rating;
  private  $mediaid;
  
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
class RatingDAO
{

//get avg rating.
function get_avg_rating($rating)
{
	$mid = $rating -> __get('mediaid');
	$con = connect();
	$res = mysqli_query($con, "SELECT ROUND(AVG(Rating),1) AS RTNG FROM rating WHERE MediaId='$mid'");
	return $res;
}
//update rating
function update_rating($rating)
{
	$rate = $rating->__get('rating');
	$uid = $rating->__get('uid');
	$mid = $rating->__get('mediaid');
	$con = connect();
	mysqli_query($con,"UPDATE rating SET Rating='$rate' WHERE UId='$uid' AND MediaId='$mid' ");
}
//rating
function get_rating_by_user($rating)
{
    $uid = $rating->__get('uid');
	$mid = $rating->__get('mediaid');
	$con = connect();
	$q1 = mysqli_query($con,"SELECT * FROM rating where UId = '$uid' AND MediaId='$mid'");
	return $q1;
}
//rating
function rate_media($rate)
{
    $rating = $rate->__get('rating');
	$uid = $rate->__get('uid');
	$mid = $rate->__get('mediaid');
	$con = connect();
	$query = "INSERT INTO rating(UId,MediaId,Rating) VALUES ('$uid','$mid','$rating')";
	mysqli_query($con,$query);
}
}
?>