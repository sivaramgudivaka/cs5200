<?php

//require 'db_connect.php';
//validate_user : validates the given uname and pwd
//returns uname if success else errors
class Comment
{
  private  $commentid;
  private  $uid;
  private  $mediaid;
  private  $comment;
  
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
class CommentsDAO
{
	//get_comments
//comments
function get_comments($comment)
{
    $mid=$comment->__get('mediaid');
	$con = connect();
	$query = mysqli_query($con,"SELECT * FROM comments WHERE MediaId = '$mid'");
	return $query;
}
//insertion into comments
function create_comment($comment)
{
	$u = $comment->__get('uid');
	$m = $comment->__get('mediaid');
	$com = $comment->__get('comment');
	$con = connect();
	$query="INSERT INTO comments(UId,MediaId,Comment) VALUES ('$u','$m','$com')";
	mysqli_query($con,$query);
}
}
?>