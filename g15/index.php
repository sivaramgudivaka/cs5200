<!DOCTYPE>

<?php session_start(); 
require '/lib/custom_query.php';
$con=connect();

if(isset($_SESSION['uname']))
	$u = $_SESSION['uname'];
?>

<html>
<title>YouTube+</title>
<head>
<script src="js/myjs.js" type="text/javascript">
</script>
<link rel="stylesheet" href="css/css.css" style="text/css"/>
<link rel="stylesheet" type="text/css" href="css/jqcloud.css" />
    <script type="text/javascript" src="js/jquery.min.js"></script>
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

</head>
<body onload="checkSession(0);">

<div id="top_bar">
	<div id="container-topbar">
		
			<a href="index.php" class="text_style1" style="padding-top:14px;float:left;">YouTube+</a>
	
	<div id="searchbar" class="searchbar" >
		<form name="search_form" id="search_form" action="browse.php" method="post">
			<input type="text" class="textBox" name="searchBox" style="width:360px;float:left;" placeholder="search media.." >
			<a href="#" onclick="sub()" class="text_style1" style="margin-left:-30px;padding-top:0.17cm;float:left;">Go</a>
			<span style="margin-left:20px;padding-top:0.18cm;position:absolute;">
			<input type="radio" name="searchi" value="title" id="r1"> <label for="r1"> Title </label>
			<input type="radio" name="searchi" value="keyword" id="r2"> <label for="r2"> Keywords </label>
			<input type="radio" name="searchi" value="category" id="r3"> <label for="r3"> Category </label>
			</span>
	</form>
	
	<script>
				function sub()
				{
					document.getElementById("search_form").submit();
				}
			</script>

<div id="greeting" class="greeting" ><?php
		if(isset($_SESSION['uname']))
			echo "Welcome ".$_SESSION['uname'];
		else
			echo "Welcome guest";
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

 <div class="container" id="options" >
        <span id="list1"> 
		<br/><br>
		    <a id="opt1" class="option_element" href="profile.php" >My Profile</a><br>
			<a id="opt2" class="option_element" href="my_channel.php" >My Channel</a><br>
			<a id="opt3" class="option_element" href="messages.php" >Inbox</a><br>
			<a id="opt31" class="option_element" href="sentM.php" >Sent Box</a><br>
			<a id="opt4" class="option_element" href="subscriptions.php" >Subscriptions</a><br>
			<a id="opt5" class="option_element" href="uploads.php" >Uploads</a><br>
			<a id="opt51" class="option_element" href="history.php" >History</a><br/>
         </span>
		 <div class="options_section_styles"></div>
		 <br/>
		 <span id="list2"> 
			<a id="opt6" class="option_element" href="myfavorites.php" >Favorites</a><br>
		    <a id="opt7" class="option_element" href="myplaylists.php" >Playlists</a><br/>
         </span>
		 <div class="options_section_styles"></div>
		 <br/>
		 <span id="list3" >
			<a id="opt8" class="option_element" href="friends.php" >Friends</a><br>
		 	<a id="opt9" class="option_element" href="blocked.php" >Blocked Users</a><br><br><br><br><br>
		
		</span>
		<br/>
		
		
			
</div >

<div style="position:absolute;left:6cm;top:2cm;width:70%;">

<div  id="comment_section" >
<h3 >Most Viewed</h3>
<?php

$mostViewed = get_most_viewed();
while($row = mysqli_fetch_array($mostViewed))
{
	$TYPE1=substr($row['MediaType'],0,5);
	if($TYPE1=="image")
	{
	$url="watch.php?v=".$row['MediaId'];
	echo "<a href=".$url. "><div class=\"vid_result\"><div id=\"header_img\"></div><span id=\"content\">". $row['Title']."</span></div></a>";
	}
	else if($TYPE1=="video")
	{
	$url="watch.php?v=".$row['MediaId'];
	echo "<a href=".$url. "><div class=\"vid_result\"><div id=\"header_vid\"></div><span id=\"content\">". $row['Title']."</span></div></a>";
	}
	else if($TYPE1=="audio")
	{
	$url="watch.php?v=".$row['MediaId'];
	echo "<a href=".$url. "><div class=\"vid_result\"><div id=\"header_aud\"></div><span id=\"content\">". $row['Title']."</span></div></a>";
	}
}
?>
</div>
<div  id="comment_section">
<h3>Recently Viewed</h3>
<?php

$mostRecentlyViewed=get_most_recently_viewed();
while($row = mysqli_fetch_array($mostRecentlyViewed))
{
	$TYPE1=substr($row['MediaType'],0,5);
	if($TYPE1=="image")
	{
	$url="watch.php?v=".$row['MediaId'];
	echo "<a href=".$url. "><div class=\"vid_result\"><div id=\"header_img\"></div><span id=\"content\">". $row['Title']."</span></div></a>";
	}
	else if($TYPE1=="video")
	{
	$url="watch.php?v=".$row['MediaId'];
	echo "<a href=".$url. "><div class=\"vid_result\"><div id=\"header_vid\"></div><span id=\"content\">". $row['Title']."</span></div></a>";
	}
	else if($TYPE1=="audio")
	{
	$url="watch.php?v=".$row['MediaId'];
	echo "<a href=".$url. "><div class=\"vid_result\"><div id=\"header_aud\"></div><span id=\"content\">". $row['Title']."</span></div></a>";
	}
}
?>
</div>
<div  id="comment_section">
<h3>Music</h3>
<?php

$category = 'Music';
$PublicMedia = get_public_media_by_category($category);
while($row = mysqli_fetch_array($PublicMedia))
{
	$TYPE1=substr($row['MediaType'],0,5);
	if($TYPE1=="image")
	{
	$url="watch.php?v=".$row['MediaId'];
	echo "<a href=".$url. "><div class=\"vid_result\"><div id=\"header_img\"></div><span id=\"content\">". $row['Title']."</span></div></a>";
	}
	else if($TYPE1=="video")
	{
	$url="watch.php?v=".$row['MediaId'];
	echo "<a href=".$url. "><div class=\"vid_result\"><div id=\"header_vid\"></div><span id=\"content\">". $row['Title']."</span></div></a>";
	}
	else if($TYPE1=="audio")
	{
	$url="watch.php?v=".$row['MediaId'];
	echo "<a href=".$url. "><div class=\"vid_result\"><div id=\"header_aud\"></div><span id=\"content\">". $row['Title']."</span></div></a>";
	}
}
?>
</div>

<div  id="comment_section">
<h3>Sports</h3>
<?php

$category = 'Sports';
$PublicMedia = get_public_media_by_category($category);
while($row=mysqli_fetch_array($PublicMedia))
{
	$TYPE1=substr($row['MediaType'],0,5);
	if($TYPE1=="image")
	{
	$url="watch.php?v=".$row['MediaId'];
	echo "<a href=".$url. "><div class=\"vid_result\"><div id=\"header_img\"></div><span id=\"content\">". $row['Title']."</span></div></a>";
	}
	else if($TYPE1=="video")
	{
	$url="watch.php?v=".$row['MediaId'];
	echo "<a href=".$url. "><div class=\"vid_result\"><div id=\"header_vid\"></div><span id=\"content\">". $row['Title']."</span></div></a>";
	}
	else if($TYPE1=="audio")
	{
	$url="watch.php?v=".$row['MediaId'];
	echo "<a href=".$url. "><div class=\"vid_result\"><div id=\"header_aud\"></div><span id=\"content\">". $row['Title']."</span></div></a>";
	}
}
?>
</div>
<div  id="comment_section">
<h3>Kids</h3>
<?php

$category = 'Kids';
$PublicMedia = get_public_media_by_category($category);
while($row=mysqli_fetch_array($PublicMedia))
{
	$TYPE1=substr($row['MediaType'],0,5);
	if($TYPE1=="image")
	{
	$url="watch.php?v=".$row['MediaId'];
	echo "<a href=".$url. "><div class=\"vid_result\"><div id=\"header_img\"></div><span id=\"content\">". $row['Title']."</span></div></a>";
	}
	else if($TYPE1=="video")
	{
	$url="watch.php?v=".$row['MediaId'];
	echo "<a href=".$url. "><div class=\"vid_result\"><div id=\"header_vid\"></div><span id=\"content\">". $row['Title']."</span></div></a>";
	}
	else if($TYPE1=="audio")
	{
	$url="watch.php?v=".$row['MediaId'];
	echo "<a href=".$url. "><div class=\"vid_result\"><div id=\"header_aud\"></div><span id=\"content\">". $row['Title']."</span></div></a>";
	}
}
?>
</div>
<div  id="comment_section">
<h3>Action</h3>
<?php

$category = 'Action';
$PublicMedia = get_public_media_by_category($category);
while($row=mysqli_fetch_array($PublicMedia))
{
	$TYPE1=substr($row['MediaType'],0,5);
	if($TYPE1=="image")
	{
	$url="watch.php?v=".$row['MediaId'];
	echo "<a href=".$url. "><div class=\"vid_result\"><div id=\"header_img\"></div><span id=\"content\">". $row['Title']."</span></div></a>";
	}
	else if($TYPE1=="video")
	{
	$url="watch.php?v=".$row['MediaId'];
	echo "<a href=".$url. "><div class=\"vid_result\"><div id=\"header_vid\"></div><span id=\"content\">". $row['Title']."</span></div></a>";
	}
	else if($TYPE1=="audio")
	{
	$url="watch.php?v=".$row['MediaId'];
	echo "<a href=".$url. "><div class=\"vid_result\"><div id=\"header_aud\"></div><span id=\"content\">". $row['Title']."</span></div></a>";
	}
}
?>
</div>
<div  id="comment_section">
<h3>Movies</h3>
<?php

$category = 'Movies';
$PublicMedia = get_public_media_by_category($category);
while($row=mysqli_fetch_array($PublicMedia))
{
	$TYPE1=substr($row['MediaType'],0,5);
	if($TYPE1=="image")
	{
	$url="watch.php?v=".$row['MediaId'];
	echo "<a href=".$url. "><div class=\"vid_result\"><div id=\"header_img\"></div><span id=\"content\">". $row['Title']."</span></div></a>";
	}
	else if($TYPE1=="video")
	{
	$url="watch.php?v=".$row['MediaId'];
	echo "<a href=".$url. "><div class=\"vid_result\"><div id=\"header_vid\"></div><span id=\"content\">". $row['Title']."</span></div></a>";
	}
	else if($TYPE1=="audio")
	{
	$url="watch.php?v=".$row['MediaId'];
	echo "<a href=".$url. "><div class=\"vid_result\"><div id=\"header_aud\"></div><span id=\"content\">". $row['Title']."</span></div></a>";
	}
}
?>
</div>
<div  id="comment_section">
<h3>Education</h3>
<?php

$category = 'Education';
$PublicMedia = get_public_media_by_category($category);
while($row=mysqli_fetch_array($PublicMedia))
{
	$TYPE1=substr($row['MediaType'],0,5);
	if($TYPE1=="image")
	{
	$url="watch.php?v=".$row['MediaId'];
	echo "<a href=".$url. "><div class=\"vid_result\"><div id=\"header_img\"></div><span id=\"content\">". $row['Title']."</span></div></a>";
	}
	else if($TYPE1=="video")
	{
	$url="watch.php?v=".$row['MediaId'];
	echo "<a href=".$url. "><div class=\"vid_result\"><div id=\"header_vid\"></div><span id=\"content\">". $row['Title']."</span></div></a>";
	}
	else if($TYPE1=="audio")
	{
	$url="watch.php?v=".$row['MediaId'];
	echo "<a href=".$url. "><div class=\"vid_result\"><div id=\"header_aud\"></div><span id=\"content\">". $row['Title']."</span></div></a>";
	}
}
?>
</div>
<div  id="comment_section">
<h3>Others</h3>
<?php

$category = 'Others';
$PublicMedia = get_public_media_by_category($category);
while($row=mysqli_fetch_array($PublicMedia))
{
	$TYPE1=substr($row['MediaType'],0,5);
	if($TYPE1=="image")
	{
	$url="watch.php?v=".$row['MediaId'];
	echo "<a href=".$url. "><div class=\"vid_result\"><div id=\"header_img\"></div><span id=\"content\">". $row['Title']."</span></div></a>";
	}
	else if($TYPE1=="video")
	{
	$url="watch.php?v=".$row['MediaId'];
	echo "<a href=".$url. "><div class=\"vid_result\"><div id=\"header_vid\"></div><span id=\"content\">". $row['Title']."</span></div></a>";
	}
	else if($TYPE1=="audio")
	{
	$url="watch.php?v=".$row['MediaId'];
	echo "<a href=".$url. "><div class=\"vid_result\"><div id=\"header_aud\"></div><span id=\"content\">". $row['Title']."</span></div></a>";
	}
}
?>
</div>
</div>
<h3 style="position:fixed;left:88%;top:1.7cm;">Word Cloud</h3>
<div id="wordcloud" style="position:fixed;left:80%;box-sizing:border-box;width: 400px;height: 620px;">

</div>
</body>
</html>