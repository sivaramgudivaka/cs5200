<?php
class media
{
	private $mediaid;
	private $medianame;
	private $mediapath;
	private $mediatype;
	private $uploadtime;
	private $uid;
	private $sharewith;
	
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

class MediaDAO
{
	//retrieve_media_by_id: retrieves media corresponding to the id
	public function retrieve_media_by_id($media)
	{
		$con = connect();
		$mid = $media->__get('mediaid');
		$query = mysqli_query($con,"SELECT * FROM media WHERE MediaId='$mid' ");
		return $query;
	}
	
	//for fetching media content based on user.
	public function media_fetch($media)
	{
		$con = connect();
		$uid = $media->__get('uid');
		$res = mysqli_query($con,"SELECT * FROM meta WHERE MediaId IN (select MediaId FROM media WHERE UId='$uid' AND ShareWith='Public')");
		return $res;
	}
	
	public function get_uploader($media)
	{
		$con=connect();
		$mid = $media->__get('mediaid');
		$res=mysqli_query($con,"SELECT UId FROM media WHERE MediaId='$mid' ");
		return $res;
	}
	
	public function create_media($media)
	{
		$con = connect();
		$medianame = $media->__get('medianame');
		$mediapath = $media->__get('mediapath');
		$mediatype = $media->__get('mediatype');
		$uid = $media->__get('uid');
		$sharewith = $media->__get('sharewith');
		$insert = "INSERT into media(MediaId,MediaName,MediaPath,MediaType,UId,ShareWith) VALUES(NULL,'$medianame','$mediapath','$mediatype','$uid','$sharewith')";
		mysqli_query($con,$insert);
		$res=mysqli_insert_id($con);
		return $res;
	}
	
	public function get_media_for_user($media)
	{
		$con = connect();
		$uid = $media->__get('uid');
		$mid = $media->__get('mediaid');
		$res = mysqli_query($con,"SELECT MediaId,Type,UId FROM likes where UId = '$uid' AND MediaId='$mid'");
		return $res;
	} 
	
	public function get_media_name_and_path($media)
	{
		$con = connect(); 
		$mediaid = $media->__get('mediaid');
		$res=mysqli_query($con,"SELECT MediaName,MediaPath FROM media WHERE MediaId='$mediaid'");
		return $res;
	}
	
	public function delete_media($media) 
	{
		$con=connect(); 
		$mediaid = $media->__get('mediaid');
		mysqli_query($con,"DELETE FROM media WHERE MediaId='$mediaid'");
	}


}

?>
