<?php
//include 'db_connect.php';
//get_most_recently_viewed : returns the most recently viewed media files
class CustomDAO
{
function get_most_recently_viewed()
{
	$con = connect();
	$most_recently_viewed = "SELECT meta.MediaType,meta.MediaId,meta.Title FROM meta RIGHT JOIN
							(SELECT DISTINCT MediaId FROM(SELECT MediaId FROM dandv WHERE Type='view' ORDER BY Time DESC) as g)as h
							on meta.MediaId=h.MediaId";
	$query = mysqli_query($con, $most_recently_viewed);
	return $query;
}

function get_most_searched()
{
	$con = connect();
	$most_searched = "SELECT MediaId,keyword FROM keywords WHERE keyword IN (SELECT keyword FROM search)
					 GROUP BY keyword ORDER BY COUNT( keyword ) DESC LIMIT 0 , 30";
	$query = mysqli_query($con,$most_searched);
	return $query;
}


//get_public_media_by_category : returns public media in the given category.
//media-meta
function get_public_media_by_category($meta)
{
	$category=$meta->__get('category');
	$con = connect();
	$PublicMediaByCat = "SELECT meta.MediaType,meta.MediaId,meta.Title FROM meta WHERE Category='$category' and MediaId IN (SELECT MediaId FROM media WHERE ShareWith='Public')";
	$query = mysqli_query($con, $PublicMediaByCat);
	return $query;
}

//meta-media
function get_uploaded_media($media)
{
	$u = $media->__get('uid');
	$con=connect();
	$res = mysqli_query($con,"SELECT * FROM meta WHERE MediaId IN(SELECT MediaId FROM media WHERE UId='$u')");
	return $res;
}

//meta-media
function update_meta($meta,$media)
{
    $title = $meta->__get('title');
	$category = $meta->__get('category');
	$desc = $meta->__get('description');
    $share = $media->__get('sharewith');
	$mid = $meta->__get('mediaid');
	$con = connect();
	mysqli_query($con,"UPDATE meta SET Title='$title', Category='$category', Description='$desc'
						WHERE MediaId='$mid'");
	mysqli_query($con,"UPDATE media SET ShareWith='$share' WHERE MediaId='$mid'");	
}
//media-plst-playlist
function media_search($playlist)
{
	$pname = $playlist->__get('pname');
	$u = $playlist->__get('uid');
	$con=connect(); 
	$res=mysqli_query($con,"SELECT MediaId,Title FROM meta WHERE MediaId IN(SELECT MediaId FROM plstfiles WHERE PId=(SELECT PId FROM playlist WHERE Pname='$pname' AND UId='$u'))");
	return $res;
}

//dandv-meta

function get_all_downloads_by_user($dandv)
{
	$uid=$dandv->__get('uid');
	$con=connect();
	$res=mysqli_query($con,"SELECT DISTINCT meta.MediaId,meta.Title FROM meta,dandv WHERE meta.MediaId IN(SELECT MediaId FROM dandv WHERE UId='$uid' AND Type='download')");
	return $res;
}

function get_all_views_by_user($dandv)	
{
	$u=$dandv->__get('uid');
	$con=connect();
	$res=mysqli_query($con,"SELECT DISTINCT meta.MediaId,meta.Title FROM meta,dandv WHERE meta.MediaId IN(SELECT MediaId FROM dandv WHERE UId='$u' AND Type='view')");
	return $res;
}	

}
?>