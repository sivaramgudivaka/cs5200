<?php
session_start();
require '/lib/custom_query.php';
$u=$_SESSION['uname'];
$uid = get_uid($u);
$m=$_GET['v'];
$q5=get_media_name_and_path($m);
$fil=mysqli_fetch_array($q5);
$path=$fil['MediaPath'].$fil['MediaName'];
if(unlink($path))
{
$q1=delete_media($m);
$q2=delete_meta($m);
$q4=delete_plstfiles($m);
echo "File Deleted Successfully!";
echo "click <a href=\"uploads.php\"> here </a> to go back.";
}
else
	header("Location:uploads.php");
?>