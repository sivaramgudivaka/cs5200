<!DOCTYPE>

<?php
session_start();
include 'lib/db_connect.php';
include '/lib/User.php';
if(!isset($_SESSION['uname']))
	header("Location:signin.php");
$u = $_SESSION['uname'];
$uid = $_SESSION['uid'];
$usr_obj = new user;
$usr_obj->__set('uid', $uid);
$usr_dao = new UserDAO;
$result = $usr_dao->retrieve_user($usr_obj);
$row = mysqli_fetch_array($result);
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
	checkSession(1);
	disableFields();
}

function enableFields()
{
		
	document.getElementById("fname_txt").style.display="block";
	document.getElementById("lname_txt").style.display="block";
	document.getElementById("uname_txt").style.display="block";
	document.getElementById("pwd_txt").style.display="block";
	document.getElementById("email_txt").style.display="block";
	document.getElementById("gender_txt").style.display="block";
	document.getElementById("DOB_txt").style.display="block";
	
	document.getElementById("fname_n").style.display="none";
	document.getElementById("lname_n").style.display="none";
	document.getElementById("uname_n").style.display="none";
	document.getElementById("pwd_n").style.display="none";
	document.getElementById("email_n").style.display="none";
	document.getElementById("gender_n").style.display="none";
	document.getElementById("DOB_n").style.display="none";
	
	document.getElementById("edit").style.display="none";
	document.getElementById("save").style.display="block";
	
	if(<?php if(isset($_SESSION['id']))echo "1"; else echo "0"; ?>)
		document.getElementById("resp").innerHTML='';
}

function disableFields()
{
	document.getElementById("fname_txt").style.display="none";
	document.getElementById("lname_txt").style.display="none";
	document.getElementById("uname_txt").style.display="none";
	document.getElementById("pwd_txt").style.display="none";
	document.getElementById("email_txt").style.display="none";
	document.getElementById("gender_txt").style.display="none";
	document.getElementById("DOB_txt").style.display="none";
	
	document.getElementById("fname_n").style.display="block";
	document.getElementById("lname_n").style.display="block";
	document.getElementById("uname_n").style.display="block";
	document.getElementById("pwd_n").style.display="block";
	document.getElementById("email_n").style.display="block";
	document.getElementById("gender_n").style.display="block";
	document.getElementById("DOB_n").style.display="block";
	
	document.getElementById("save").style.display="none";
	document.getElementById("edit").style.display="block";
}

function submitForm()
{
	document.getElementById("profile_form").submit();
	
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
  
<div style="position:absolute;top:3cm;left:8cm;">
  <table align="center" cellpadding="6" cellspacing="8" border="0">
	 <form name="profile_form" id="profile_form" action="profile_update.php" method="post">	
		<tr>
		<td >First Name:</td>
		<td id="fname_txt"><input type="text" name="fname" id="fname" class="textBox" value="<?php echo $row['FirstName'];?>" required ></td>
		<td id="fname_n"><?php echo $row['FirstName'];?> </td>
		</tr>
		<tr>
		<td >Last Name:</td>
		<td id="lname_txt"><input type="text" name="lname" id="lname" class="textBox"value="<?php echo $row['LastName'];?>" required></td>
		<td id="lname_n"><?php echo $row['LastName'];?> </td>
		</tr>		
		<tr>
		<td>Username:</td>
		<td id="uname_txt"><input type="text" name="uname" id="uname" class="textBox" value="<?php echo $row['Uname'];?>" disabled ></td>
		<td id="uname_n"><?php echo $row['Uname']; ?> </td>
		</tr>
		<tr>
		<td>Password:</td>
		<td id="pwd_txt"><input type="password" name="pwd" class="textBox" id="pwd" value="<?php echo $row['Password'];?>" required></td>
		<td id="pwd_n">***</td>
		</tr>
		<tr>
		<td >Email:</td>
		<td id="email_txt"><input type="text" name="mail" class="textBox" id="email" value="<?php echo $row['Email'];?>" required></td>
		<td id="email_n"><?php echo $row['Email']; ?> </td>
		</tr>
		<tr>
		<td >Gender:</td>
		<td id="gender_txt">Male <input type="radio" name="gender" id="gender" value="Male" id="gender" <?php if ($row['Gender']=="Male") echo "checked";?> >
		Female <input type="radio" name="gender" id="gender2" value="Female" <?php if($row['Gender']=="Female") echo "checked";?>  ></td>
		<td id="gender_n"><?php echo $row['Gender']; ?> </td>
		</tr>
		<tr>
		<td >DOB:(m/d/Y)</td>
		<td id="DOB_txt"><input type="text" id="datepicker" name="DOB" class="textBox"  value="<?php $date = new DateTime($row['DOB']); echo  $date->format('m/d/Y'); ?>" required></td>
		<td id="DOB_n"><?php $date = new DateTime($row['DOB']); echo  $date->format('m/d/Y'); ?> </td>
		</tr>
		<tr> <td></td>
		<td colspan="2" id="edit"><input type="button" id="btn" value="Edit" onclick="enableFields()"> </td>
		<td colspan="2" id="save"><input type="submit" id="btn" value="Save" > </td>
      </form>
	 </table>
	  <p id="resp" class="text_style1"><?php if(isset($_SESSION['id'])) echo "Profile updated successfully!"; unset($_SESSION['id']); ?></p>
</div>


</body>
</html>