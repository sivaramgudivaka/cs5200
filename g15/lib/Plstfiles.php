<?php
 
 class Plstfiles
{
	private  $pid;
	private  $mediaid;
	private  $plstid;

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
class PlstfilesDAO
{	
	public function insert_into_playlist($plstfiles)
	{
		$pid = $plstfiles->__get('pid');
		$mid = $plstfiles->__get('mediaid');
		$con = connect();
		mysqli_query($con,"INSERT INTO plstfiles(PId,MediaId) VALUES ('$pid','$mid')");
	}	
	public function  delete_plstfiles($plstfiles)
	{
		$m = $plstfiles->__get('mediaid');
		$con=connect();
		mysqli_query($con,"DELETE FROM plstfiles WHERE MediaId='$m'");
	}
	
	public function get_playlist_files($plstfiles)
	{
		$p = $plstfiles->__get('pid');
		$m = $plstfiles->__get('mediaid');
		$con=connect();
		$res = mysqli_query($con,"SELECT * FROM plstfiles WHERE PId = '$p' AND MediaId = '$m'");
		return $res;
	}
}
?>