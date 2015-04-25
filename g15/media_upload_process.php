<?php
session_start();
require '/lib/custom_query.php';

$username=$_SESSION['uname'];
$uid = get_uid($username);
$con = connect();

//Create Directory if doesn't exist
if(!file_exists('uploads/'))
	mkdir('uploads/', 0777);
$dirfile = 'uploads/'.$username.'/';
if(!file_exists($dirfile))
	mkdir($dirfile, 0777);
if(!isset($_POST['Save']))
{		
	exit("File not accepted.<br> click <a href=\"upload_media.php\">here</a> to try uploading another file.");
}
	

$mtype=	substr($_FILES["file"]["type"],0,5);
if ($mtype=="audio"||$mtype=="video"||$mtype=="image")

 {

  if ($_FILES["file"]["error"] > 0)
  {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
  }
 else 
 {	
	 $upfile = $dirfile.mysqli_real_escape_string($con,$_FILES["file"]["name"]);
    if (file_exists($upfile))
      echo mysqli_real_escape_string($con,$_FILES["file"]["name"]) . " already exists. ";
	else
	{
		$medianame=mysqli_real_escape_string($con,$_FILES["file"]["name"]);
		$mediatype=$_FILES["file"]["type"];
        move_uploaded_file($_FILES["file"]["tmp_name"],$upfile);
	    $sharewith=$_POST['sharewith_list'];
	   
					$mediaid = create_media($medianame,$dirfile,$mediatype,$uid,$sharewith);
					$string=$_POST['keywords'];
					$title=$_POST['title'];
					$description=$_POST['description'];
					$category=$_POST['category_list'];
					create_meta($title,$description,$mediaid,$mediatype,$category);
					$tok = strtok($string, ",");
					$keys = '';
					$insertKeyword = '';
					while ($tok != false)
					{
						$insertKeyword.=" ('".$tok."','$mediaid') ,";						
						$tok=strtok(",");
						
					}
						$keys= substr($insertKeyword, 0, -2);
						create_keywords($keys);
						echo "File uploaded Successfully!<br>";
						echo "click <a href=\"upload_media.php\">here</a> to upload another file.";	
	}
    }
  }

 else
 {
 echo "File upload failed!<br>";
 echo "click <a href=\"upload_media.php\">here</a> to try uploading another file.";
}
?>


