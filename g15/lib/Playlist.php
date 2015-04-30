<?php
 
class Playlist
{
	private  $pid;
	private  $pname;
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
class PlaylistDAO
{	
	//gets playlist by userid
	public function get_playlist_by_id($playlist)
	{
		$uid = $playlist->__get('uid');
		$con = connect();
		$res = mysqli_query($con,"SELECT * FROM playlist WHERE UId='$uid'");
		return $res;
	}
	//creates playlist
	public function create_playlist($playlist)
	{
		$pname = $playlist->__get('pname');
		$uid = $playlist->__get('uid');
		$con=connect();
		$res=mysqli_query($con,"INSERT INTO playlist (Pname,UId) VALUES ('$pname','$uid')");
		return $res;
	}
	//gets playlist by name
	public function get_playlist_by_name($playlist)
	{
		$pname = $playlist->__get('pname');
		$uid = $playlist->__get('uid');
		$con = connect();
		$result = mysqli_query($con,"SELECT PId FROM playlist WHERE Pname='$pname' AND UId='$uid'");
		return $result;
	}
	
	//gets the playlist names by userid
	public function get_playlist_name($playlist)
	{	$uid = $playlist->__get('uid');
		$con = connect();
		$res = mysqli_query($con,"SELECT Pname FROM playlist WHERE UId='$uid'");
		return $res;
	}
	//gets playlist by name and userid
	public function get_all_playlists($playlist)
	{
		$pname = $playlist->__get('pname');
		$u= $playlist->__get('uid');
		$con=connect();
		$res=mysqli_query($con,"SELECT * FROM playlist WHERE Pname='$pname' AND UId='$u'");
		return $res;

	}	
	
}
?>