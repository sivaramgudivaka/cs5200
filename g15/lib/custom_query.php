<?php

require 'user.php';

//get_most_searched : returns the most searched media files
function get_most_searched()
{
	$con = connect();
	$most_searched = "SELECT MediaId,keyword FROM keywords WHERE keyword IN (SELECT keyword FROM search WHERE NOT keyword = '')
					 GROUP BY keyword ORDER BY COUNT( keyword ) DESC LIMIT 0 , 30";
	$query = mysqli_query($con,$most_searched);
	return $query;
}

//get_most_viewed : returns the most viewed media files
function get_most_viewed()
{
	$con = connect();
	$most_viewed = "SELECT meta.MediaType,meta.MediaId,meta.Title,count(*) AS C FROM meta JOIN dandv ON
					meta.MediaId=dandv.MediaId GROUP BY MediaId ORDER BY C DESC";
	$query = mysqli_query($con, $most_viewed);
	return $query;
}

//get_most_recently_viewed : returns the most recently viewed media files
function get_most_recently_viewed()
{
	$con = connect();
	$most_recently_viewed = "SELECT meta.MediaType,meta.MediaId,meta.Title FROM meta RIGHT JOIN
							(SELECT DISTINCT MediaId FROM(SELECT MediaId FROM dandv WHERE Type='view' ORDER BY Time DESC) as g)as h
							on meta.MediaId=h.MediaId";
	$query = mysqli_query($con, $most_recently_viewed);
	return $query;
}

//get_public_media_by_category : returns public media in the given category.
function get_public_media_by_category($category)
{
	$con = connect();
	$PublicMediaByCat = "SELECT meta.MediaType,meta.MediaId,meta.Title FROM meta WHERE Category='$category' and MediaId IN (SELECT MediaId FROM media WHERE ShareWith='Public')";
	$query = mysqli_query($con, $PublicMediaByCat);
	return $query;
}

//retrieve_media_by_id: retrieves media corresponding to the id
function retrieve_media_by_id($id)
{
	$con = connect();
	$query = mysqli_query($con,"SELECT * FROM media WHERE MediaId = '$id' ");
	return $query;
}

//retrieve_blocked: retrieves blocked people
function retrieve_blocked($blocker, $blocked)
{
	$con = connect();
	$query = mysqli_query($con,"SELECT Blocked FROM block WHERE Blocked='$blocked' AND Blocker='$blocked'");
	return $query;
}

//create_media_view: records a new watch/view for a media
function create_media_view($mid, $type, $uid)
{
	$con = connect();
	mysqli_query($con, "INSERT INTO dandv(MediaId,Type,UId) values ('$mid','$type','$uid')");
}

//get_media_view: gets watch/view for a media
function get_media_view($mid)
{
	$con = connect();
	$query = mysqli_query($con, "SELECT * FROM dandv WHERE MediaId = '$mid' AND Type='view' ");
	return $query;
}

//retrieve_meta_by_id: retrieves meta info of media corresponding to the id
function retrieve_meta_by_id($mid)
{
	$con = connect();
	$query = mysqli_query($con,"SELECT * FROM meta WHERE MediaId = '$mid' ");
	return $query;
}

//block_user : for user blocking
//ravi
function block_user($blocker,$blocked)
{
   $con=connect();
   $res=mysqli_query($con,"INSERT INTO block (Blocker,Blocked) VALUES ('$blocker','$blocked')" );
   return $res;
}

//media_content_extract: extracting media
//ravi.
function media_content_extract()
{
    $con = connect();  
	$qn = "SELECT MediaId,keyword FROM keywords WHERE keyword IN (SELECT keyword FROM search WHERE NOT keyword = '') GROUP BY keyword ORDER BY COUNT(keyword) DESC LIMIT 0 , 30";
	$query = mysqli_query($con, $qn);
	return $query;
}

//get_likes: gets likes/dislikes
function get_likes($mid, $type)
{
	$con = connect();
	$query = mysqli_query($con,"SELECT Type FROM likes WHERE MediaId='$mid' AND Type='$type'");
	return $query;
}

//get_likes_per_user: gets likes/dislikes
function get_likes_per_user($mid, $uid)
{
	$con = connect();
	$query = mysqli_query($con, "SELECT * FROM likes where UId = '$uid' AND MediaId='$mid'");
	return $query;
}

//for fetching media content based on user.
function media_fetch($uid)
{
	$con = connect();
	$res = mysqli_query($con,"SELECT * FROM meta WHERE UId='$uid' AND ShareWith='Public'");
	return $res;
}

function get_playlist_by_id($uid)
{
	$con = connect();
	$res = mysqli_query($con,"SELECT Pname FROM playlist WHERE UId='$uid'");
	return $res;
}

function get_avg_rating($mid)
{
	$con = connect();
	$res = mysqli_query($con, "SELECT ROUND(AVG(Rating),1) AS RTNG FROM rating WHERE MediaId='$mid'");
	return $res;
}

//get_comments
function get_comments($mid)
{
	$con = connect();
	$query = mysqli_query($con,"SELECT * FROM comments WHERE MediaId = '$mid'");
	return $query;
}

//get_subscriptions
function get_subscriptions($subscr, $subto)
{
	$con = connect();
	$query = mysqli_query($con,"SELECT Subscriber FROM subscriptions WHERE Subscriber='$subscr' AND SubscribedTo='$subto'");
	return $query;
}

function get_uploaded_media($u)
{
	$con=connect();
	$res = mysqli_query($con,"SELECT * FROM meta WHERE MediaId IN(SELECT MediaId FROM media WHERE UId='$u')");
	return $res;
}

function get_media_by_title($t)
{
	$con=connect();
	$res = mysqli_query($con,"SELECT * FROM meta WHERE Title='$t'");
	return $res;
}

function get_keywords($mid)
{
	$con = connect();
	$result = mysqli_query($con,"SELECT keyword FROM keywords WHERE MediaId='$mid'");
	return $result;
}

function channels_subscribed_by_user($u)
{
	$con = connect();
	$res = mysqli_query($con,"SELECT SubscribedTo FROM subscriptions WHERE Subscriber='$u'");
	return $res;
}

function channels_subscribed_for_user($u)
{
	$con = connect();
	$res = mysqli_query($con,"SELECT Subscriber FROM subscriptions WHERE SubscribedTo='$u'");
	return $res;
}

function get_uploader($mid)
{
	$con=connect();
	$res=mysqli_query($con,"SELECT UId FROM media WHERE MediaId='$mid' ");
	return $res;
}

function create_playlist($pname,$uid)
{
	$con=connect();
	$res=mysqli_query($con,"INSERT INTO playlist (Pname,UId) VALUES ('$pname','$uid')");
	return $res;
}

function get_received_messages($u)
{
	$con = connect();
	$res = mysqli_query($con,"SELECT Sender,Message,Time FROM messages WHERE Receiver='$u' ORDER BY Time DESC");
	return $res;
}

function get_sent_messages($u)
{
	$con = connect();
	$res = mysqli_query($con,"SELECT Receiver,Message,Time FROM messages WHERE Sender='$u' ORDER BY Time DESC");
	return $res;
}

function update_rating($rate, $uid, $mid)
{
	$con = connect();
	mysqli_query($con,"UPDATE rating SET Rating='$rate' WHERE UId='$uid' AND MediaId='$mid' ");
}

function get_rating_by_user($uid, $mid)
{
	$con = connect();
	$q1 = mysqli_query($con,"SELECT * FROM rating where UId = '$uid' AND MediaId='$mid'");
	return $q1;
}

function rate_media($uid, $mid, $rating)
{
	$con = connect();
	$query = "INSERT INTO rating(UId,MediaId,Rating) VALUES ('$uid','$mid','$rating')";
	mysqli_query($con,$query);
}

function get_playlist_by_name($pname, $uid)
{
	$con = connect();
	$result = mysqli_query($con,"SELECT PId FROM playlist WHERE Pname='$pname' AND UId='$uid'");
	return $result;
}

function insert_into_playlist($pid, $mid)
{
	$con = connect();
	mysqli_query($con,"INSERT INTO plstfiles(PId,MediaId) VALUES ('$pid','$mid')");
}

function add_subscription($from, $to)
{
	$con=connect();
	mysqli_query($con,"INSERT INTO subscriptions(Subscriber,SubscribedTo) values ('$from','$to')");
}

function get_playlist_name($uid)
{
	$con = connect();
	$res = mysqli_query($con,"SELECT Pname FROM playlist WHERE UId='$uid'");
	return $res;
}

function get_receiver($u)
{
	$con=connect();
	$res=mysqli_query($con,"SELECT Uname FROM user WHERE Uname='$u' ");	
	return $res;
}

function send_message($uid, $receiver, $msg)
{
	$con = connect();
	mysqli_query($con,"INSERT INTO messages(Sender,Receiver,Message) values ('$uid','$receiver','$msg')");
}

function update_meta($title, $category, $desc, $share, $mid)
{
	$con = connect();
	mysqli_query($con,"UPDATE meta SET Title='$title', Category='$category', Description='$desc',
						ShareWith='$share' WHERE MediaId='$mid'");
}

function delete_keywords($mid)
{
	$con = connect();
	mysqli_query($con,"DELETE FROM keywords WHERE MediaId='$mid'");
}

function create_media($medianame,$dirfile,$mediatype,$uid,$sharewith)
{
	 $con = connect();
	 $insert = "INSERT into media(MediaId,MediaName,MediaPath,MediaType,UId,ShareWith) VALUES(NULL,'$medianame','$dirfile','$mediatype','$uid','$sharewith')";
	 mysqli_query($con,$insert);
	 $res=mysqli_insert_id($con);
	 return $res;
}

function create_meta($title,$description,$mediaid,$type,$category)
{
	 $con = connect();
	 $insert = "insert into meta(MediaId,Title,Description,Category,MediaType) values('$mediaid','$title','$description','$category','$type')";
	 mysqli_query($con,$insert);
	 
}

function create_keywords($keys)
{
	$con = connect();
	mysqli_query($con, "insert into keywords(keyword,MediaId) values ".$keys);
}

function add_download($u,$m)
{
	$con=connect();
	$insertDownload="insert into dandv(UId,MediaId,Type) values('$u','$m','download')";
	mysqli_query($con,$insertDownload);
}

function get_media_for_user($u,$m)
{
	$con=connect();
	$res=mysqli_query($con,"SELECT MediaId,Type,UId FROM likes where UId = '$u' AND MediaId='$m'");
	return $res;
} 

function update_like($u,$m,$t)
{
	$con=connect();
	mysqli_query($con,"UPDATE likes SET Type='$t' WHERE UId='$u' AND MediaId='$m' ");
	$res=mysqli_query($con,"SELECT MediaId FROM likes WHERE Type='$t' AND MediaId='$m'");
	return $res;
}
function add_like($u,$t,$m)
{
    $con=connect();
	$query="INSERT INTO likes(UId,MediaId,Type) VALUES ('$u','$m','$t')";
	mysqli_query($con,$query);
	$res=mysqli_query($con,"SELECT MediaId FROM likes WHERE Type='$t' AND MediaId='$m'");
	return $res;
}

function get_all_views_by_user($u)	
{
	$con=connect();
	$res=mysqli_query($con,"SELECT DISTINCT meta.MediaId,meta.Title FROM meta,dandv WHERE meta.MediaId IN(SELECT MediaId FROM dandv WHERE UId='$u' AND Type='view')");
	return $res;
}	


function pending_reqs($u)
{
	$con = connect();
	$res=mysqli_query($con,"SELECT * FROM friends WHERE UId='$u' AND reqStat='pending'");
	return $res;
}

function respond_to_friend_req($uid, $friend, $reqstat)
{
	$q1="UPDATE friends SET reqStat='$reqstat' WHERE UId='$uid' AND friend='$friend' ";
	$res=mysqli_query($con,$q1);
}

function get_friends($uid)
{
	$q1="SELECT * FROM friendreq WHERE UId='$uid' OR friend='$uid' AND reqStat='accepted'";
	$res = mysqli_query($con, $q1);
	return res;
}

function media_search($pname,$u)
{
	$con=connect(); 
	$res=mysqli_query($con,"SELECT MediaId,Title FROM meta WHERE MediaId IN(SELECT MediaId FROM plstfiles WHERE PId=(SELECT PId FROM playlist WHERE Pname='$pname' AND UId='$u'))");
	return $res;
}

function get_media_name_and_path($m)
{
	$con=connect(); 
	$res=mysqli_query($con,"SELECT MediaName,MediaPath FROM media WHERE MediaId='$m'");
	return $res;
}

function get_all_but_not_this_user($user)
{
    $con = connect();
	$q1=mysqli_query($con,"SELECT * FROM user WHERE NOT UId = '$user'");
	return $q1;
}

function create_comment($u, $m, $com)
{
	$con = connect();
	$query="INSERT INTO comments(UId,MediaId,Comment) VALUES ('$u','$m','$com')";
	mysqli_query($con,$query);
}
function get_all_downloads_by_user($uid)
{
	$con=connect();
	$res=mysqli_query($con,"SELECT DISTINCT meta.MediaId,meta.Title FROM meta,dandv WHERE meta.MediaId IN(SELECT MediaId FROM dandv WHERE UId='$uid' AND Type='download')");
	return $res;
}
function get_all_playlists($pname,$u)
{
	$con=connect();
	$res=mysqli_query($con,"SELECT * FROM playlist WHERE Pname='$pname' AND UId='$u'");
	return $res;

}

function retrieve_blocked_user($uid)
{
	$con = connect();
	$res=mysqli_query($con,"SELECT Blocked FROM block WHERE Blocker='$uid'");
	return $res;
}


function get_blocked_users($user)
{
    $con = connect();
	$q1=mysqli_query($con,"SELECT UId FROM user WHERE NOT UId IN (SELECT Blocked FROM block WHERE Blocker='$user')");
	return $q1;
}


?>