<?php

class dandv
{
	private $dnid;
	private $mediaid;
	private $type;
	private $uid;
	private $time;
	
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

class DandvDAO
{
	public function get_most_viewed()
	{
		$con = connect();
		$most_viewed = "SELECT meta.MediaType,meta.MediaId,meta.Title,count(*) AS C FROM meta JOIN dandv ON
					    meta.MediaId=dandv.MediaId GROUP BY MediaId ORDER BY C DESC";
		$query = mysqli_query($con, $most_viewed);
		return $query;
	}
	
	public function add_download($dandv)
	{
		$uid = $dandv->__get('uid');
		$mediaid = $dandv->__get('mediaid');
		$type = $dandv->__get('type');
		$con = connect();
		$insertDownload="insert into dandv(UId,MediaId,Type) values('$uid','$mediaid','$type')";
		mysqli_query($con,$insertDownload);
	}
	
	//create_media_view: records a new watch/view for a media
	public function create_media_view($dandv)
	{
		$mid = $dandv->__get('mediaid');
		$type = $dandv->__get('type');
		$uid = $dandv->__get('uid');
		$con = connect();
		mysqli_query($con, "INSERT INTO dandv(MediaId,Type,UId) values ('$mid','$type','$uid')");
	}
	
	//get_media_view: gets watch/view for a media
	public function get_media_view($dandv)
	{
		$mid=$dandv->__get('mediaid');
		$con = connect();
		$query = mysqli_query($con, "SELECT * FROM dandv WHERE MediaId = '$mid' AND Type='view' ");
		return $query;
	}
	
}


?>
