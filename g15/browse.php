<!DOCTYPE>

<?php 
include '/lib/Search.php';
include '/lib/db_connect.php';
 $con=connect();?>

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


</head>
<body onload="checkSession(0);">

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


<div style="position:absolute;top:2cm;margin-left:5.3cm;width:60%;float:left;box-sizing:border-box;"> 
<?php 
$searchq=$_POST['searchBox'];
$type=$_POST['search_by_type'];
$category=$_POST['search_by_category'];
if($searchq=='')
	exit("No results found!"); 

$tokenArray=explode(" ",$searchq);
$q1="SELECT * FROM meta WHERE MediaId IN (";
$q2="INSERT INTO search VALUES ";
for($i=0;$i<count($tokenArray);$i++)//generate search query with unions
		{
			$q1.="SELECT MediaId FROM keywords WHERE keyword RLIKE '$tokenArray[$i]' OR '$tokenArray[$i]' RLIKE keyword UNION
			SELECT MediaId FROM meta WHERE Title RLIKE '$tokenArray[$i]' OR '$tokenArray[$i]' RLIKE Title UNION ";
			$q2.= "('".$tokenArray[$i]."'),";
		}
if($category=='Category' && $type=='Type')     //universal search
    {
		$q1=substr($q1,0,-7);
		$q1.= ")";
		$q2=substr($q2,0,-1);
	}
else   //filtered search
	{
		if($category=='Category' && $type!='Type')    //search only by type
		    {
			    $q1 = substr($q1,0,-7);
				$q1.=")";
				$filter = " AND MediaType=".$type;
				$q1.= $filter;
				$q2=substr($q2,0,-1);
			}
		else if($category!='Category' && $type=='Type')    //search only by category
		   {
				$q1 = substr($q1,0,-7);
				$q1.=")";
				$filter = " AND Category=".$category;
				$q1.= $filter;
				$q2=substr($q2,0,-1);
			}
		else
			{    //search by category and type
				$q1 = substr($q1,0,-7);
				$q1.=")";
				$filter = " AND Category=".$category." AND MediaType=".$type;
				$q1.= $filter;
				$q2=substr($q2,0,-1);
			}
	}

$result=mysqli_query($con,$q1);
mysqli_query($con,$q2);

if(!$result||mysqli_num_rows($result)==0)
{
	$str = "YoutubeApiResults.php?str=".$searchq;
	header("Location: ".$str);
}
else
{
while($row=mysqli_fetch_array($result))
{
	$TYPE=$row['MediaType'];
	if($TYPE=="image")
	{
	$url="watch.php?v=".$row['MediaId'];
	echo "<a href=".$url. "><div class=\"vid_result\"><div id=\"header_img\"></div><span id=\"content\">". $row['Title']."</span></div></a>";
	}
	else if($TYPE=="video")
	{
	$url="watch.php?v=".$row['MediaId'];
	echo "<a href=".$url. "><div class=\"vid_result\"><div id=\"header_vid\"></div><span id=\"content\">". $row['Title']."</span></div></a>";
	}
	else if($TYPE=="audio")
	{
	$url="watch.php?v=".$row['MediaId'];
	echo "<a href=".$url. "><div class=\"vid_result\"><div id=\"header_aud\"></div><span id=\"content\">".$row['Title']."</span></div></a>";
	}
	
}

}
 ?>



</div>
<h3 style="position:fixed;left:88%;top:1.7cm;">Word Cloud</h3>
<div id="wordcloud" style="position:fixed;left:80%;box-sizing:border-box;width: 400px;height: 620px;">
</div>
</body>
</html>