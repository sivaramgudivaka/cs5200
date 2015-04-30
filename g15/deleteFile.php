<?php
session_start();
include 'lib/db_connect.php';
include '/lib/Media.php';
$u = $_SESSION['uname'];
$uid = $_SESSION['uid'];
$m = $_GET['v'];
$media_obj = new media;
$media_obj->__set('mediaid', $m);
$media_dao = new MediaDAO;
$q5 = $media_dao->get_media_name_and_path($media_obj);
$fil = mysqli_fetch_array($q5);
$path = $fil['MediaPath'].$fil['MediaName'];
if(unlink($path))
{
$media_dao->delete_media($media_obj);
echo "File Deleted Successfully!";
echo "Redirecting to your <a href=\"uploads.php\">uploads</a> shortly.";
header( "refresh:2;url=uploads.php" );
}
else
	header("Location:uploads.php");
?>