<?php
session_start();
include '/lib/Meta.php';
include '/lib/CustomDAO.php';
include '/lib/Media.php';
include '/lib/Keywords.php';
include '/lib/db_connect.php';
$con = connect();
$title=$_POST['title'];
$category=$_POST['category_list'];
$desc=$_POST['description'];
$mid=$_POST['mid'];
$share=$_POST['sharewith_list'];

//meta object
$meta_obj = new meta;
$meta_obj->__set('title', $title);
$meta_obj->__set('description', $desc);
$meta_obj->__set('mediaid', $mid);
$meta_obj->__set('mediatype', $mediatype);
$meta_obj->__set('category', $category);
$media_obj = new media;
$media_obj->__set('sharewith', $share);
$custom_dao = new CustomDAO;
$custom_dao->update_meta($meta_obj, $media_obj);

$string=$_POST['keywords'];
$keywords_obj = new keywords;
$keywords_obj->__set('mediaid', $mid);
$keywords_dao = new Keywords_DAO;
$keywords_dao->delete_keywords($keywords_obj);
$tok = strtok($string, ",");
$keys = '';
$insertKeyword = '';
while ($tok != false)
	{
		$insertKeyword.=" ('".$tok."','$mid') ,";						
		$tok=strtok(",");
	}
	$keys= substr($insertKeyword, 0, -2);
	$keywords_dao = new Keywords_DAO;
	$keywords_dao->create_keywords($mid, $keys);
	header("Location:uploads.php");	
?>


