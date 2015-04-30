<?php
session_start();
include '/lib/db_connect.php';
include '/lib/Media.php';
include '/lib/User.php';
include '/lib/Block.php';
include '/lib/Dandv.php';
include '/lib/Meta.php';
include '/lib/Search.php';
include '/lib/Like.php';
include '/lib/Playlist.php';
include '/lib/Plstfiles.php';
include '/lib/Rating.php';
include '/lib/Comments.php';
include '/lib/Subscriptions.php';
if(isset($_SESSION['uname']))
	$u = $_SESSION['uname'];

?>

<html>
<title>YouTube+</title>
<head>
<script src="js/myjs.js" type="text/javascript">
</script>

<link rel="stylesheet" href="css/css.css" style="text/css"/>

<script src="js/me/build/jquery.js"></script>
<script src="js/me/build/mediaelement-and-player.min.js"></script>
<link rel="stylesheet" href="js/me/build/mediaelementplayer.css" />
<link rel="stylesheet" type="text/css" href="css/jqcloud.css" />
   
    <script type="text/javascript" src="js/jqcloud-1.0.4.js"></script>
 <script type="text/javascript">
      
      var word_array = [
	  <?php
	  $searchdao=new SearchDAO;
	  $most_searched = $searchdao->get_most_searched();
	  $uri="watch.php?v=";
	  $str='';
	  while($row = mysqli_fetch_array($most_searched))
		  {
			  $str.= "{text: \"".$row['keyword']."\", weight: ".mt_rand(5,9).", link: \"".$uri.$row['MediaId']."\"},";
		  }
	$str=substr($str,0,-1);
	echo $str;
	  ?> 
	  ];

      $(function() {
        // When DOM is ready, select the container element and call the jQCloud method, passing the array of words as the first argument.
        $("#wordcloud").jQCloud(word_array);
      });
  </script>	
<script type="text/javascript">

function rate(val)
{
		var midv=document.getElementById("mid").value;
	if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
   
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	document.getElementById("rating_avg").innerHTML=xmlhttp.responseText;		
    }
  }
 
  xmlhttp.open("GET","rate.php?r="+val+"&m="+midv,true);
  xmlhttp.send();
  
}


function addToPlaylist()
{
	var playlist=document.getElementById("plst");
	var p = playlist.value;
	if(p=='') alert("select a playlist");
	else{
	
	var btn=document.getElementById("plast");
	btn.innerHTML="Added";
	btn.disabled=true;
	
	var m=document.getElementById("mid").value;
	if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }

 
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		
    }
  }

	xmlhttp.open("GET","playlist.php?p="+p+"&m="+m,true);
  xmlhttp.send();
  }
}

function subscrib(thist)
{
	if(new String(document.getElementById("STATUSSUB").value)=="own")
		alert("You don't need to subscribe to your own chanel.");
	else{
	thist.innerHTML="Subscribed !";
	
	if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }

    var midv=document.getElementById("mid").value;
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		
    }
  }


  xmlhttp.open("GET","subscribe.php?m="+midv,true);
  xmlhttp.send();
  }
	
}
function checkSub()
{	
	var val=document.getElementById("subscribe");
	var str=new String(document.getElementById("STATUSSUB").value);
			if(str=="tru")
			{
			val.disabled=true;
			//val.style.backgroundColor="#C0C0C0";
			val.innerHTML="Subscribed!";
			}
			if(str=="own")
			{
				val.innerHTML="own channel";
				val.disabled=true;
			}
}



function checkLogin()
{

	if(<?php if(isset($_SESSION['uname'])) echo "0"; else echo "1";?>)
	{
		document.getElementById("like").disabled=true;
		document.getElementById("dislike").disabled=true;
		document.getElementById("dislike").style.backgroundColor="#C0C0C0";
		document.getElementById("like").style.backgroundColor="#C0C0C0";
		document.getElementById("cmnt_btn").style.backgroundColor="#C0C0C0";
		document.getElementById("cmnt_btn").disabled=true;
		document.getElementById("comment").placeholder="Please Login to Comment and Like videos.";
		document.getElementById("comment").disabled=true;
		
		for(var i=1;i<6;i++)
		{
			document.getElementById("r"+i).disabled=true;
		}
		var val=document.getElementById("subscribe");
		val.style.backgroundColor="#C0C0C0";
		val.disabled="true";
		document.getElementById("fav").disabled=true;
		document.getElementById("plast").disabled=true;
		
		document.getElementById("logout").style.display="none";
		document.getElementById("options").style.display="none";
	}
	
	
}



function start()
{
checkLogin();	
checkSub();

	var status=document.getElementById("likeStatus").value;
	if(status=="like"){
		document.getElementById("like").disabled=true;
	document.getElementById("dislike").disabled=false;
	//document.getElementById("like").style.backgroundColor="#C0C0C0";
	document.getElementById("like").innerHTML="Liked";
	document.getElementById("dislike").style.backgroundColor="#bd362f";
	}
	else if(status=="dislike")
	{
		document.getElementById("dislike").disabled=true;
	document.getElementById("like").disabled=false;
	//document.getElementById("dislike").style.backgroundColor="#C0C0C0";
	document.getElementById("dislike").innerHTML="Disliked";
	document.getElementById("like").style.backgroundColor="#5bb75b";
	document.getElementById("like").innerHTML="Like";
	}
	else
	{
		var i=5;//do nothing.
	}
	
checkSession(0);
}

function AjaxComment()
{
	var com=document.getElementById("comment").value;
	var un=document.getElementById("uname").value;
	if(com=='')
		alert("Comment cannot be empty!");
	else{
	var midv=document.getElementById("mid").value;
	var parent=document.getElementById("whole");
	var last_node=document.getElementById("comment_box");
	var div1 = document.createElement('div');
	div1.setAttribute('id', 'comment_section');
	parent.insertBefore(div1,last_node);	
	document.getElementById("comment").value='';
	document.getElementById("comment").focus();
	window.scrollTo(0,document.body.scrollHeight);
	//div ends here
	
	if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
   com=escape(com);
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		div1.innerHTML="<b>"+un+":<br /></b>";
		div1.innerHTML+=(xmlhttp.responseText).replace(/\n/g, "<br />");		
    }
  }
 
  xmlhttp.open("GET","comment.php?q="+com+"&m="+midv,true);
  xmlhttp.send();
  }
}

function likes(type)
{
	var t=type;
	if(type=='like')
	{
		if(document.getElementById("dislike").disabled)
			{
				var count=parseInt(document.getElementById("numdislikes").innerHTML);
				document.getElementById("numdislikes").innerHTML=(count==0?0:--count);
			}
	document.getElementById("like").disabled=true;
	document.getElementById("dislike").disabled=false;
	//document.getElementById("like").style.backgroundColor="#C0C0C0";
	document.getElementById("like").innerHTML="Liked";
	document.getElementById("dislike").style.backgroundColor="#bd362f";
	document.getElementById("dislike").innerHTML="Dislike";
	type="numlikes";
	}
	else if(type=='dislike')
	{
		if(document.getElementById("like").disabled)
			{
				var count=parseInt(document.getElementById("numlikes").innerHTML);
				document.getElementById("numlikes").innerHTML=(count==0?0:--count);
			}
	document.getElementById("dislike").disabled=true;
	document.getElementById("like").disabled=false;
	//document.getElementById("dislike").style.backgroundColor="#C0C0C0";
	document.getElementById("dislike").innerHTML="Disliked";
	document.getElementById("like").style.backgroundColor="#5bb75b";
	document.getElementById("like").innerHTML="Like";
	type="numdislikes";
	}
	
	
		if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
   var lik=document.getElementById(type);
    var midv=document.getElementById("mid").value;
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		lik.innerHTML=xmlhttp.responseText;
    }
  }


  xmlhttp.open("GET","like.php?m="+midv+"&t="+t,true);
  xmlhttp.send();
  }
  
</script>


</head>

<body onload="start();">

<div id="top_bar">
	<div id="container-topbar">
		
			<a href="index.php" class="text_style1" style="padding-top:14px;float:left;font-size:18px;">YouTube+</a>
	
	<div id="searchbar" class="searchbar" >
		<form name="search_form" id="search_form" action="browse.php" method="post">
			<input type="text" class="textBox" name="searchBox" style="width:360px;float:left;" placeholder="search media.." >
			<a href="#" onclick="sub()" class="text_style1" style="margin-left:-30px;padding-top:0.17cm;float:left;">Go</a>
			<span style="margin-left:20px;padding-top:0.02cm;position:absolute;">
			Filter by:&nbsp;
			<select name="search_by_category" class="filter">
				<option value="Category">Category</option>
				<option value="Sports">Sports</option>
				<option value="Music">Music</option>
				<option value="Kids">Kids</option>
				<option value="Action">Action</option>
				<option value="Education">Education</option>
				<option value="Movies">Movies</option>
				<option value="Others">Others</option>
			</select>
			&nbsp;&nbsp;
			<select name="search_by_type" class="filter">
				<option value="Type">Type</option>
				<option value="video">video</option>
				<option value="audio">audio</option>
				<option value="image">image</option>
			</select>
			</span>
	    </form>
			<script>
				function sub()
				{
					document.getElementById("search_form").submit();
				}
			</script>
	
	

<div id="greeting" class="greeting" ><?php
			echo "Welcome ".$u;
		?></div>

</div>



<div id="auth_options" style="position:absolute;right:2cm;top:0.2cm;">

	<a id="upload" class="auth_opt" href="upload_media.php">Upload</a>

	<a id="login" class="auth_opt" href="signin.php" >Sign In</a>
		
	<a id="logout" class="auth_opt" href="logout.php">Sign Out</a>
	
	<a id="register" class="auth_opt" href="register.php">Sign Up</a>	
</div>

</div>

</div>

<?php

$mid = $_GET['v'];
$media_obj = new media;
$media_obj->__set('mediaid', $mid);
$mediadao = new MediaDAO;
$result = $mediadao->retrieve_media_by_id($media_obj);
$row = mysqli_fetch_array($result);
$url = $row['MediaPath'].$row['MediaName'];
$upid = $row['UId'];
$user_obj = new user;
$user_obj->__set('uid',$upid);
$userdao_obj= new UserDAO;
$upname = $userdao_obj->get_uname($user_obj);
$usr = $userdao_obj->retrieve_user($user_obj);
$usr_res = mysqli_fetch_array($usr);
$uid = $_SESSION['uid'];
$block_obj = new Block;
$block_obj->__set('blocker',$usr_res['UId']);
$block_obj->__set('blocked',$uid);
$block_dao = new BlockDAO;
$block = $block_dao->retrieve_blocked($block_obj);
$blk = mysqli_fetch_array($block);
$shrwith = $row['ShareWith'];
if(($shrwith=="Private"&&$upid!=$uid)||$blk['Blocked']== $uid)
	header("Location:redirect.php");
else if($shrwith=="None"&&$upid!=$uid)
	header("Location:block_redirect.php");
else
{
	$media_obj=new media;
	$dandv_obj = new dandv;
	$dandv_obj->__set('mediaid', $mid);
	$dandv_obj->__set('type', 'view');
	$dandv_obj->__set('uid', $uid);
	$dandv_dao = new DandvDAO;
	$dandv_dao->create_media_view($dandv_obj);
}
$meta_ob = new meta;
$meta_ob->__set('mediaid', $mid);
$meta_dao1 = new MetaDAO;
$meta = $meta_dao1->retrieve_meta_by_id($meta_ob);
$row3 = mysqli_fetch_array($meta);

$dandv_obj2 = new dandv;
$dandv_obj2->__set('mediaid', $mid);
$dandv_dao3 = new DandvDAO;
$view = $dandv_dao->get_media_view($dandv_obj2);
$view = mysqli_num_rows($view);

?>
 
<div style="position:absolute;left:5.5cm;right:20%;width:60%;height:100%;top:1.9cm;" id="whole">

<div style="height:380;float:left;"> 
<br>
 <?php
 $typ=substr($row3['MediaType'],0,5);
 if($typ=="video")
 echo "<video src=\"".$url."\" width=\"640\" height=\"380\"></video>";
 else if($typ=="audio")
 echo "<audio src=\"".$url."\" width=\"640\" height=\"380\"></audio>";
 else if($typ=="image")
 echo "<img src=\"".$url."\" width=\"640\" height=\"380\"></img>";
 ?>
 

 
</div>


<div style="float:left;width:96%;"> 
 
<h2 class="text_style1" style="margin-left:1%;white-space:nowrap;"><?php echo $row3['Title'];?> </h2>
 
</div>


<div style="float:left;"> 

<button class="vid_btn" id="subscribe" onclick="subscrib(this)" style="float:left;">Subscribe</button>
<button class="vid_btn" id="plast" onclick="addToPlaylist()" style="float:left;position:absolute;left:2.8cm;">+Playlist</button>
<button class="vid_btn" onclick="likes('like')" id="like" style="position:absolute;left:7.5cm;float:left;background-color:#5bb75b;">Like</button>
<button class="vid_btn" onclick="likes('dislike')" id="dislike" style="position:absolute;left:10.5cm;float:left;background-color:#bd362f;">Dislike</button>
<h2 style="position:absolute;left:14.9cm;float:left;top:11.4cm;">views</h2> 
</div>

<input type="hidden" id="likeStatus" value="<?php
$like_obj = new like;
$like_dao = new LikeDAO;
$like_obj->__set('mediaid', $mid);
$like_obj->__set('uid', $uid);
$like_obj->__set('type', 'like');
$likes = $like_dao->get_likes($like_obj);
$num_likes = mysqli_num_rows($likes);

$like_obj->__set('type', 'dislike');
$dislikes = $like_dao->get_likes($like_obj);
$num_dislikes = mysqli_num_rows($dislikes);


$likes_per_usr = $like_dao->get_likes_per_user($like_obj);
$res1 = mysqli_fetch_array($likes_per_usr);
if($res1['UId']==$uid)//check if user already liked/disliked
echo $res1['Type'];
else echo "none";
?>" > 


<div style="float:left;border-bottom:1px solid #e5e5e5;">
<br/>
<span style="float:left;position:absolute;left:0.2cm;top:13cm;">
by <a class="text_style1" href="<?php echo "channel.php?uid=".$upid;?>" ><?php echo $upname;?> </a>
</span>
<span style="position:absolute;margin-left:0.6cm;top:12.92cm;float:left;">
<?php
if(isset($_SESSION['uname']))
{
	$playlst_obj = new Playlist;
	$playlst_obj->__set('uid', $uid);
	$plst_dao = new PlaylistDAO;
	$resply = $plst_dao->get_playlist_by_id($playlst_obj);
	echo "<select name=\"playlist_opt\" id=\"plst\"><option value=\"\"></option>";
	while($ply = mysqli_fetch_array($resply))
		{
			$pname = $ply['Pname'];
			$pid = $ply['PId'];
			$plstfs_ob = new Plstfiles;
			$plstfs_ob->__set('pid', $pid);
			$plstfs_ob->__set('mediaid', $mid);
			$plstf_dao = new PlstfilesDAO;
			$result4 = $plstf_dao->get_playlist_files($plstfs_ob);
			if(mysqli_num_rows($result4)==0)
				echo "<option value=\"".$pname."\">".$pname."</option>";
			else
				echo "<option value=\"".$pname."\" selected>".$pname."</option>";
		}
		echo "</select>";
} 
?>
</span>
<br/>
<h2 style="position:absolute;margin-left:5.5cm;top:12.92cm;float:left;background: no-repeat url(css/www-hitchhiker-vflJlqqP8.webp) -112px -291px;height: 18px;width: 18px;"></h2>
<h2 style="position:absolute;margin-left:6cm;float:left;" class="text_style1" id="numlikes"><?php echo $num_likes; ?> </h2>
<h2 style="position:absolute;margin-left:8.5cm;top:12.92cm;float:left;background: no-repeat url(css/www-hitchhiker-vflJlqqP8.webp) -94px -255px;height: 18px;width: 18px;"></h2>
<h2 style="position:absolute;margin-left:9cm;float:left;" class="text_style1" id="numdislikes"><?php echo $num_dislikes;?></h2>
<h2 style="position:absolute;margin-left:12.6cm;float:left;" class="text_style1" id="num_views"> <?php echo $view; ?></h2>
<br/>
</div>

<?php
		$rating_obj = new rating;
		$rating_obj->__set('mediaid', $mid);
		$rate_dao = new RatingDAO;
		$res23 = $rate_dao->get_avg_rating($rating_obj);
		$row23=mysqli_fetch_array($res23);
		$rating=$row23['RTNG'];
?>


 <div id="comment_section" > 
 <br/><br/><br/>
<h3>Total Rating: </h3>
<h2 class="text_style1" id="rating_avg" style="position:absolute;margin-left:4cm;top:14.58cm;"><?php echo $rating;?> </h2>
 <span class="text_style1" style="position:absolute;margin-left:7cm;top:15.2cm;" id="rating">
  <input type="radio" name="rating" id="r1" value="1" onclick="rate(1)"><b>1</b>
  <input type="radio" name="rating" id="r2" value="2" onclick="rate(2)"><b>2</b>
  <input type="radio" name="rating" id="r3" value="3" onclick="rate(3)"><b>3</b>
  <input type="radio" name="rating" id="r4" value="4" onclick="rate(4)"><b>4</b>
  <input type="radio" name="rating" id="r5" value="5" onclick="rate(5)"><b>5</b>
  <strong class="text_style1">&nbsp;&nbsp;&nbsp;Rate now!</strong>
</span>
<br/>
	
   <label class="text_style1" >About this video</label>
 
   <a href="media_download_process.php?m=<?php echo $mid;?>" id="btn" style="background-color:#5bb75b;position:absolute;left:13cm;text-align:center;">Download</a>
   
   
<p style="width:60%;"><?php echo $row3['Description'];?> </p>

</div>
 
   <input type="hidden" value="<?php echo $mid;?>" id="mid">
   <input type="hidden" value="<?php echo $u;?>" id="uname">
   
     
 <div id="comment_section"> <p class="text_style1">Comments</p></div>
   
 <?php
 $comment_obj = new Comment;
 $comment_obj->__set('mediaid', $mid);
 $cmnt_dao = new CommentsDAO;
 $res = $cmnt_dao->get_comments($comment_obj);
 $commenter_id = $row['UId'];
 $cmntr_obj = new user;
 $cmntr_obj->__set('uid', $commenter_id);
 $cmntr_dao = new UserDAO;
 $cmntr_name = $cmntr_dao->get_uname($cmntr_obj);
while($row = mysqli_fetch_array($res))
{
echo "<div id=\"comment_section\"><b>".$cmntr_name.":</b><br/>".nl2br($row['comment'])."</div>";
}
?>
    
<input type="hidden" id="STATUSSUB" value="<?php if($u=="guest") echo "guest";
 else{
if($u==$upname)
	echo "own";
else{
	$sub = new Subscriptions;
	$sub->__set('subscriber', $uid);
	$sub->__set('subscribedto', $upid);
	$sub_dao = new SubscriptionsDAO;
	$rese = $sub_dao->get_subscriptions($sub);
$e=mysqli_fetch_array($rese);
if($e['Subscriber']==$uid)//if I already subscribed to the uploader
	echo "tru";
else	
	echo "unsubscribed";
}
	}
?>" >
   
<div id="comment_box"> 
 <br/>
 <textarea name="comment" rows="3" cols="60" id="comment" placeholder="Leave a  comment.." wrap="hard" required></textarea>
 <button class="vid_btn" style="background-color:#5bb75b;position:relative;top:-23px;" onclick="AjaxComment()" id="cmnt_btn">Comment</button>

</div>
</div>

<h3 style="position:fixed;left:31cm;top:1.7cm;">Word Cloud</h3>
<div id="wordcloud" style="position:fixed;left:28cm;box-sizing:border-box;width: 350px;height: 620px;">

</div>
</body>

<script>
$('video,audio').mediaelementplayer();
</script>
</html>