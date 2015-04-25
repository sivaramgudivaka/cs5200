<?php
session_start();
require '/lib/custom_query.php';

	  $title=$_POST['title'];
	  $category=$_POST['category_list'];
	  $desc=$_POST['description'];
	  $mid=$_POST['mid'];
	  $share=$_POST['sharewith_list'];
	  $string=$_POST['keywords'];
	  update_meta($title, $category, $desc, $share, $mid);
	  delete_keywords($mid);
		$tok = strtok($string, ",");
		$insertKeyword = "insert into keywords(keyword,MediaId) values ";
		while ($tok != false)
		{
			$insertKeyword.=" ('".$tok."','$mid') ,";						
			$tok=strtok(",");
		}
			$insertKeyword= substr($insertKeyword, 0, -2);
		$key=mysqli_query($con,$insertKeyword) or die("Insert into keywords error in media_upload_process.php " .mysql_error());
		header("Location:uploads.php");	
?>


