<?php
session_start();
include '/lib/db_connect.php';
include '/lib/Playlist.php';
$u = $_SESSION['uname'];
$uid = $_SESSION['uid'];
$pname = $_POST['plname'];
$playlist=new Playlist;
$playlist->__set('pname',$pname);
$playlist->__set('uid',$uid);
$playlistdao=new PlaylistDAO;
$result = $playlistdao->get_all_playlists($playlist);
$row = mysqli_fetch_array($result);
$pid = $row['PId'];
if(mysqli_num_rows($result)==0)
{
	$result = $playlistdao->create_playlist($playlist);
	header("Location:myplaylists.php");
}
else
	echo "Playlist already exists!<br> Click <a href=\"createplay.php\"> here</a> to go back and make a new playlist";

?>