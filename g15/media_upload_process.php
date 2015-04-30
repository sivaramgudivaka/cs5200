<?php
session_start();
include '/lib/Media.php';
include '/lib/Meta.php';
include '/lib/Keywords.php';
include '/lib/db_connect.php';

$username=$_SESSION['uname'];
$uid = $_SESSION['uid'];
$con = connect();

//Create Directory if doesn't exist
if(!file_exists('uploads/'))
	mkdir('uploads/', 0777);
$dirfile = 'uploads/'.$username.'/';
if(!file_exists($dirfile))
	mkdir($dirfile, 0777);
if(!isset($_POST['Save']))
	exit("File not accepted.<br> click <a href=\"upload_media.php\">here</a> to try uploading another file.");	

$mtype=	substr($_FILES["file"]["type"],0,5);
if ($mtype=="audio"||$mtype=="video"||$mtype=="image")
	{
		if ($_FILES["file"]["error"] > 0)
			echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
		else
		{
			$upfile = $dirfile.mysqli_real_escape_string($con,$_FILES["file"]["name"]);
			if (file_exists($upfile))
				echo mysqli_real_escape_string($con,$_FILES["file"]["name"]) . " already exists. ";
			else
			{
				$medianame=mysqli_real_escape_string($con,$_FILES["file"]["name"]);
				$mediatype=$mtype;				
				move_uploaded_file($_FILES["file"]["tmp_name"],$upfile);
				$sharewith=$_POST['sharewith_list'];
				
				//media object
				$media_obj = new media;
				$media_obj->__set('medianame', $medianame);
				$media_obj->__set('mediapath', $dirfile);
				$media_obj->__set('mediatype', $mediatype);
				$media_obj->__set('uid', $uid);
				$media_obj->__set('sharewith', $sharewith);
				$media_dao = new MediaDAO;
				$mediaid = $media_dao->create_media($media_obj);
				
				$string=$_POST['keywords'];
				$title=$_POST['title'];
				$description=$_POST['description'];
				$category=$_POST['category_list'];
								
				//meta object
				$meta_obj = new meta;
				$meta_obj->__set('title', $title);
				$meta_obj->__set('description', $description);
				$meta_obj->__set('mediaid', $mediaid);
				$meta_obj->__set('mediatype', $mediatype);
				$meta_obj->__set('category', $category);
				$meta_dao = new MetaDAO;
				$meta_dao->create_meta($meta_obj);
				
				$tok = strtok($string, ",");
				$keys = '';
				$insertKeyword = '';
				while ($tok != false)
					{
						$insertKeyword.=" ('".$tok."','$mediaid') ,";						
						$tok=strtok(",");
					}
				$keys= substr($insertKeyword, 0, -2);
				$keywords_dao = new KeywordsDAO;
				$keywords_dao->create_keywords($mediaid, $keys);
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


