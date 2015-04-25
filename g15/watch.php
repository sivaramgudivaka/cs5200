<?php session_start(); 
require '/lib/custom_query.php';
//$con=connect();

if(isset($_SESSION['uname']))
	$u = $_SESSION['uname'];
//else
	//$u = 'guest';
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
	  $most_searched = get_most_searched();
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
	if(status=="ALIKE"){
		document.getElementById("like").disabled=true;
	document.getElementById("dislike").disabled=false;
	//document.getElementById("like").style.backgroundColor="#C0C0C0";
	document.getElementById("like").innerHTML="Liked";
	document.getElementById("dislike").style.backgroundColor="#bd362f";
	}
	else if(status=="ADLIKE")
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
		
			<a href="index.php" class="text_style1" style="padding-top:14px;float:left;">YouTube+</a>
	
	<div id="searchbar" class="searchbar" >
		<form name="search_form" id="search_form" action="browse.php" method="post">
			<input type="text" class="textBox" name="searchBox" style="width:360px;float:left;" placeholder="search media.." >
			<a href="#" onclick="sub()" class="text_style1" style="margin-left:-30px;padding-top:0.17cm;float:left;">Go</a>
			<span style="margin-left:20px;padding-top:0.18cm;position:absolute;">
			Title <input type="radio" name="searchi" value="title">
			Keywords <input type="radio" name="searchi" value="keyword">
			Category <input type="radio" name="searchi" value="category">
			</span>
			<script>
				function sub()
				{
					document.getElementById("search_form").submit();
				}
			</script>
		</form>
	
	

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
$result = retrieve_media_by_id($mid);
$row = mysqli_fetch_array($result);
$url = $row['MediaPath'].$row['MediaName'];
$upid = $row['UId'];
$upname = get_uname($upid);
$usr = retrieve_user($upid);
$usr_res = mysqli_fetch_array($usr);
$uid = get_uid($u);
$block = retrieve_blocked($usr_res['UId'], $uid );
$blk = mysqli_fetch_array($block);
$shrwith = $row['ShareWith'];
if(($shrwith=="Private"&&$row['Uname']!=$u)||$blk['Blocked']== $uid)
	header("Location:redirect.php");
else if($shrwith=="None"&&$row['Uname']!=$u)
	header("Location:block_redirect.php");
else

	create_media_view($mid,'view',$uid);
	//echo "shiva";

$meta = retrieve_meta_by_id($mid);
$row3 = mysqli_fetch_array($meta);

$view = get_media_view($mid);
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
$likes = get_likes($mid,'like');
$num_likes = mysqli_num_rows($likes);
$dislikes = get_likes($mid,'dislike');
$num_dislikes = mysqli_num_rows($dislikes);
$likes_per_usr = get_likes_per_user($mid, $uid);
$res1 = mysqli_fetch_array($likes_per_usr);
if($res1['UId']==$uid)
{
if($res1['Type']=="like")
		echo "ALIKE";
else if($res1['Type']=="dislike")
		echo "ADLIKE";
}
else echo "none";
?>" > 


<div style="float:left;border-bottom:1px solid #e5e5e5;">
<br/>
<?php
$res_1 = mysqli_fetch_array($usr);
$uploader = $res_1['Uname'];
$uploader_id = $res_1['UId'];
?>
<span style="float:left;position:absolute;left:0.2cm;top:13cm;">
by <a class="text_style1" href="<?php echo "channel.php?uid=".$uploader_id;?>" ><?php echo $uploader;?> </a>
</span>
<span style="position:absolute;margin-left:0.6cm;top:12.92cm;float:left;">
<?php
if(isset($_SESSION['uname']))
{
	$p_uid = get_uid($u);
	$resply = get_playlist_by_id($p_uid);
	echo "<select name=\"playlist_opt\" id=\"plst\"><option value=\"\"></option>";
	while($ply = mysqli_fetch_array($resply))
		{
			$p=$ply['Pname'];
			echo "<option value=\"".$p."\">".$p."</option>";
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
		$res23 = get_avg_rating($mid);
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
$res = get_comments($mid);
while($row = mysqli_fetch_array($res))
{
echo "<div id=\"comment_section\"><b>".get_uname($row['UId']).":</b><br/>".nl2br($row['comment'])."</div>";
}
?>
    
<input type="hidden" id="STATUSSUB" value="<?php if($u=="guest")	echo "guest"; else{
if($u==$uploader)
	echo "own";
else{
$rese=get_subscriptions($uid, $uploader_id);
$e=mysqli_fetch_array($rese);
if($e['Subscriber']==get_uid($u))
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