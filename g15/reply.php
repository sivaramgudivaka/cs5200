<!DOCTYPE>

<?php
session_start();
include 'lib/db_connect.php';
include '/lib/User.php';
include '/lib/Messages.php';
if(!isset($_SESSION['uname']))
	header("Location:signin.php");
$u = $_SESSION['uname'];
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
	checkSession(3);

}

</script>

</head>
<body onload="start()">

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

  
<div style="position:absolute;top:17%;left:8cm;">
  <table align="center" cellpadding="6" cellspacing="8" border="0">
	 <form name="msg_form" id="msg_form" action="msgResponse.php" method="POST">	
		<tr>
		<td >From:</td>
		<td><?php echo $u; ?></td>
		</tr>
		<tr>
		<td >To:</td>
		<td><?php
			$msgid = $_GET['msgid'];
			$msgs = new Messages;
			$msgs->__set('messageid', $msgid);
			$msg_dao = new MessagesDAO;
			$msg_query = $msg_dao->get_message($msgs);
			$res = mysqli_fetch_array($msg_query);
			$sender = $res['Sender'];
			$to = new user;
			$to->__set('uid', $sender);
			$to_dao = new UserDAO;
			$to_name = $to_dao->get_uname($to);
			echo $to_name; ?></td>
		<input type="hidden" name="receiver" value="<?php echo $to_name; ?>">
		
		</tr>
		
		<tr>
		<td>Reply:</td>
		<td><textarea name="message" class="textBox" style="height:auto;width:100%;" rows="5" cols="70" required></textarea></td>
		</tr>
		<tr><td></td>
		<td colspan="2" id="sendM"><input type="submit" id="btn" value="Send" > </td>
		</tr>
      </form>
	 </table>
	
</div>


</body>
</html>