<?php
session_start();
include 'lib/db_connect.php';
include '/lib/Meta.php';
include '/lib/Keywords.php';
if(!isset($_SESSION['uname']))
	header("Location:signin.php");


?>
<html>
<title>YouTube+</title>
<head>

<script type="text/javascript" src="js/myjs.js"></script>
<script type="text/javascript" src="js/jQuery.min.js"></script>
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
<?php
$mid = $_GET['mid'];
$meta_obj = new meta;
$meta_obj->__set('mediaid', $mid);
$metadao = new MetaDAO;
$result = $metadao->get_meta($meta_obj);
$row = mysqli_fetch_array($result);
$type = substr($row['MediaType'],0,5);
$category = $row['Category'];
$share = $row['ShareWith'];

$keywords = new keywords;
$keywords->__set('mediaid',$mid);
$keywordsdao = new KeywordsDAO;
$result3 = $keywordsdao->get_keywords($keywords);
$keyword='';
while($row3 = mysqli_fetch_array($result3))
{
	$keyword.= $row3['keyword'].",";
}
$keyword=substr($keyword,0,-1);
?>

<div style="position:absolute;top:3cm;left:8cm;">
  <table align="center" cellpadding="6" cellspacing="8" border="0">
	<form method="post" action="meta_update_process.php" enctype="multipart/form-data" >
	<tr>
		<td >Title:</td>
		<td id="title_txt"><input type="text" name="title" id="title" class="textBox" value="<?php echo $row['Title'];?>" required ></td>
		</tr>	
		<tr>
		<td>Media Type:</td><td> <select name="type_list" class="textBox" required>
				<option value=""></option>
				<option value="video" <?php if($type=="video") echo "selected";?> >video</option>
				<option value="audio" <?php if($type=="audio") echo "selected";?>>audio</option>
				<option value="image" <?php if($type=="image") echo "selected";?>>image</option>
			</select></td>
		</tr>
		<input type="hidden" name="mid" value="<?php echo $mid;?>" >
		<tr>
		<td>Category(Genre)</td>
		<td><select name="category_list" class="textBox" required>
				<option value="" ></option>
				<option value="Sports" <?php if($category=="Sports") echo "selected";?> >Sports</option>
				<option value="Music" <?php if($category=="Music") echo "selected";?> >Music</option>
				<option value="Kids" <?php if($category=="Kids") echo "selected";?> >Kids</option>
				<option value="Action" <?php if($category=="Action") echo "selected";?> >Action</option>
				<option value="Education" <?php if($category=="Education") echo "selected";?> >Education</option>
				<option value="Movies" <?php if($category=="Movies") echo "selected";?> >Movies</option>
				<option value="Others" <?php if($category=="Others") echo "selected";?> >Others</option>
			</select></td>		
		</tr>
		<tr>
		<td>Description:</td>
		<td><textarea name="description" class="textBox" style="height:auto;" rows="5" cols="20"><?php echo $row['Description']; ?></textarea></td>
		</tr>
		<tr>
		<td>Share with:</td>
		<td><select name="sharewith_list" class="textBox" required>
				<option value=""></option>
				<option value="Public" <?php if($share=="Public") echo "selected";?> >Public</option>
				<option value="Private" <?php if($share=="Private") echo "selected";?> >Private</option>
				<option value="No one" <?php if($share=="None") echo "selected";?> >No one</option>
				</td>
		</tr>
		<tr>
		<td>Keywords:</td><td>  <input type="text" name="keywords" class="textBox" placeholder="separate by commas." value="<?php echo $keyword; ?>" required> </td>
		</tr>
		<td colspan="2" id="save"><input type="submit" id="btn" value="Update" > </td>
      </form>
	 </table>
	 
</div>



</body>
</html>