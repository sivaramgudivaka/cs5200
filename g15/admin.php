<!DOCTYPE>

<?php
session_start();
include 'lib/db_connect.php';
require '/lib/User.php';
if(!isset($_SESSION['uname']))
	header("Location:signin.php");
$u = $_SESSION['uname'];
$uid = $_SESSION['uid'];
$user_obj= new user;
$user_obj->__set('uname',$u);
$user_obj->__set('uid',$uid);
$userdao_obj= new UserDAO;
$res1 = $userdao_obj->retrieve_user($user_obj);
$res1 = mysqli_fetch_array($res1);
if($res1['Role']!="admin")
	header("Location:index.php");
?>

<html>
<title>YouTube+</title>
<head>
<script src="js/myjs.js" type="text/javascript"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>   
    <script src="js/script.js"></script>    
	<link rel="stylesheet" href="css/css.css" style="text/css"/>
   
<script type="text/javascript">
function start()
{
	checkSession(9);

}
</script>

</head>
<body onload="start()">

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

  
<div style="position:absolute;top:11%;left:6cm;">
  <table align="center" cellpadding="6" cellspacing="8" border="0">
  
		
	
			<tr class="display_style">
		<td><b>All Users</b></td>	
		
		</tr>
	
		<?php

		$res = $userdao_obj->get_all_but_not_this_user($user_obj);
		while($row=mysqli_fetch_array($res))
		{
		$id = $row['UId'];
		$name=$row['Uname'];
		$role=$row['Role'];
		$op_url = "adminoperations.php?uid=".$id."&op=";
		$channel = "channel.php?uid=".$id;
		$snd_name = $userdao_obj->get_uname($user_obj);
		echo "<tr class=\"display_style\"><td><a class=\"auth_opt\" href=\"".$channel."\">".$name.
			 "</a></td><td><a href=\"".$op_url."pro\" class=\"auth_opt\">Promote</a></td>
			 <td><a href=\"".$op_url."dem\" class=\"auth_opt\">Demote</a></td>
			 <td><a href=\"".$op_url."del\" class=\"auth_opt\">Delete User</a></td></tr>";
		}
		
		?>
		
		<tr><td><b>List of admins<b></td></tr>
		<?php
		$res = $userdao_obj->get_all_but_not_this_user($user_obj);
		while($row=mysqli_fetch_array($res))
		{
		$id = $row['UId'];
		$name = $row['Uname'];
		if($row['Role']!="admin")
			continue;
		echo "<tr><td><a href=\"channel.php?uid=".$id."\" class=\"auth_opt\">".$name."</a></td></tr>";
		}
		?>
	
	
 
	 </table>
	  
</div>


</body>
</html>