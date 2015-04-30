<?php 
session_start();
include 'lib/db_connect.php';
include '/lib/User.php';
include '/lib/Media.php';
?>

<html>
<title>YouTube+</title>
<head>
<script src="js/myjs.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/css.css" style="text/css"/>
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
			Filter by:&nbsp;
			<select name="search_by_category">
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
			<select name="search_by_type">
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
		 <span id="list3" >
			<a id="opt7" class="option_element" href="myplaylists.php" >Playlists</a><br/>
			<a id="opt8" class="option_element" href="friends.php" >Friends</a><br>
		 	<a id="opt9" class="option_element" href="blocked.php" >Blocked Users</a><br><br><br><br><br>		
		</span>
		<br/>
		<div class="options_section_styles"></div>
		
			
</div >


<div style="position:absolute;top:1.5cm;margin-left:5.3cm;width:70%;height:auto;float:left;box-sizing:border-box;" class="text_style1"> 
<?php
$uid=$_GET['uid'];
$user_obj= new user;
$user_obj->__set('uid',$uid);
$userdao_obj= new UserDAO;
$uname=$userdao_obj->get_uname($user_obj);
echo "<h2>".$uname."'s Channel</h2>";
?>
</div>

<div style="position:absolute;top:3cm;margin-left:5.3cm;width:70%;height:auto;float:left;box-sizing:border-box;"> 
<?php
$media_obj=new Media;
$media_obj->__set('uid',$uid);
$media_dao = new MediaDAO;
$result = $media_dao->media_fetch($media_obj);
while($row=mysqli_fetch_array($result))
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


 


</body>

</html>