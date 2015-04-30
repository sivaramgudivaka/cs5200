<?php
//include 'db_connect.php';
class meta
{
	private $mediaid;
	private $title;
	private $description;
	private $category;
	private $mediatype;
		
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

class MetaDAO
{
	public function retrieve_meta_by_id($meta)
	{
			$mid = $meta->__get('mediaid');
			$con = connect();
			$query = mysqli_query($con,"SELECT * FROM meta WHERE MediaId = '$mid' ");
			return $query;
	}
	
	public function get_meta($meta)
	{
		$m = $meta->__get('mediaid');
		$con=connect();
		$res = mysqli_query($con,"SELECT * FROM meta JOIN media WHERE meta.MediaId='$m'");
		return $res;
	}
	
	public function media_fetch($meta)
	{
		$con = connect();
		$uid = $meta->__get('uid');
		$res = mysqli_query($con,"SELECT * FROM meta WHERE MediaId IN (select MediaId FROM media WHERE UId='$uid' AND ShareWith='Public')");
		return $res;
	}
	
	public function create_meta($meta)
	{
		$title = $meta->__get('title');
		$description = $meta->__get('description');
		$mediaid = $meta->__get('mediaid');
		$type= $meta->__get('mediatype');
		$category= $meta->__get('category');
		$con = connect();
		$insert = "insert into meta(MediaId,Title,Description,Category,MediaType) values('$mediaid','$title','$description','$category','$type')";
		mysqli_query($con,$insert);
	}
	
	function  delete_meta($meta)
	{
		$con=connect();
		$mediaid = $meta->__get('mediaid');
		mysqli_query($con,"DELETE FROM meta WHERE MediaId='$mediaid'");
	}

}

?>
