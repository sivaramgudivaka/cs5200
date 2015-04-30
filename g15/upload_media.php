<?php
 session_start();
include 'lib/db_connect.php';
if(!isset($_SESSION['uname']))
	header("Location:signin.php");


?>
<html>
<title>YouTube+</title>
<head>

<script type="text/javascript" src="js/myjs.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script>
$(document).ready(function(){
$(".upload").click(function(){
 $("#original").click();
});
});
</script>


<link rel="stylesheet" href="css/css.css" style="text/css"/>


</head>
<body onload="checkSession(0)">

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


<div style="position:absolute;top:10%;left:25%;">
  <table align="center" cellpadding="6" cellspacing="8" border="0">
	<form method="post" action="media_upload_process.php" enctype="multipart/form-data" >
	<tr><td><input type="hidden" name="MAX_FILE_SIZE" value="838860800" ></td></tr>
		<tr>
		<td>Select media to upload: <label style="color:#3498db"><strong> (Limit: 100MB per File)</strong></label></td>
		
		
		<td><input  name="file" type="file" style="display:none;" id="original"></td>
		<td><input  name="file_select" type="button" value="Select" id="btn" class="upload" ></td>
		</tr>
	</table>
	<p style="color:#3498db;">Please type in more details about your media. (Meta Info)</p>
	 <table align="center" cellpadding="6" cellspacing="8" border="0">
		<tr>
		<td>Title:</td>
		<td><input type="text" name="title" id="title" class="textBox" required></td>
		</tr>		
		<tr>
		<td>Media Type:</td><td> <select name="type_list" class="textBox" required>
				<option value=""></option>
				<option value="video">video</option>
				<option value="audio">audio</option>
				<option value="image">image</option>
			</select></td>
		</tr>
		<tr>
		<td>Category(Genre)</td>
		<td><select name="category_list" class="textBox" required>
				<option value=""></option>
				<option value="Sports">Sports</option>
				<option value="Music">Music</option>
				<option value="Kids">Kids</option>
				<option value="Action">Action</option>
				<option value="Education">Education</option>
				<option value="Movies">Movies</option>
				<option value="Others">Others</option>
			</select></td>		
		</tr>
		<tr>
		<td>Description:</td>
		<td><textarea name="description" class="textBox" style="height:auto;" rows="5" cols="20"></textarea></td>
		</tr>
		<tr>
		<td>Share with:</td>
		<td><select name="sharewith_list" class="textBox" required>
				<option value=""></option>
				<option value="Public">Public</option>
				<option value="Private">Private</option>
				<option value="No one">None</option></td>
				</select>
		</tr>
		<tr>
		<td>Keywords:</td><td>  <input type="text" name="keywords" class="textBox" placeholder="separate by commas." required></td>
		</tr>
		<tr>
		<td></td>
		<td colspan="2"><input type="submit" name="Save" id="btn" value="Upload"> </td>
		</tr>
      </form>
	 </table>
	 
</div>



</body>
</html>