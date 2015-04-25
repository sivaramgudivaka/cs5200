<?php
session_start();
require '/lib/custom_query.php';
$u = $_SESSION['uname'];
$uid = get_uid($u);
$pname = $_POST['plname'];
$result = get_all_playlists($pname,$uid);
$row = mysqli_fetch_array($result);
$pid = $row['PId'];
if(mysqli_num_rows($result)==0)
{
	$result = create_playlist($pname,$uid);
	header("Location:myplaylists.php");
}
else
	echo "Playlist already exists!<br> Click <a href=\"createplay.php\"> here</a> to go back and make a new playlist";

?>