<!DOCTYPE>
<?php
session_start();
 include 'lib/db_connect.php';
 include '/lib/CustomDAO.php';
 $con=connect();?>

<html>
<title>YouTube+</title>
<head>
<meta charset="UTF-8" />					
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Youtube+ videos" />
<script src="js/myjs.js" type="text/javascript">
</script>
<link rel="stylesheet" href="css/css.css" style="text/css"/>
<link rel="stylesheet" type="text/css" href="css/jqcloud.css" />
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jqcloud-1.0.4.js"></script>
 <script type="text/javascript">
      
       
      var word_array = [
	  <?php
	  $customdao_obj = new CustomDAO;
	  $most_searched = $customdao_obj->get_most_searched();
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
  <div class="row">
            <div class="col-md-6 col-md-offset-3"  id="youtubesearch">
                <form action="#" id="youform" hidden>
                    <p><input type="text" id="search" placeholder="Type something..." autocomplete="off" class="form-control"></p>
                    <input type="submit" id="btn" value="Search" class="form-control btn btn-primary w100">
                </form>
                
            </div>
        </div>

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


<div style="position:absolute;top:2cm;margin-left:5.3cm;width:60%;float:left;box-sizing:border-box;"> 
<div id="results"></div>



</div>
<h3 style="position:fixed;left:88%;top:1.7cm;">Word Cloud</h3>
<div id="wordcloud" style="position:fixed;left:80%;box-sizing:border-box;width: 400px;height: 620px;">
</div>
 <!-- scripts -->		
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
		<script>
		
		function tplawesome(e,t){res=e;for(var n=0;n<t.length;n++){res=res.replace(/\{\{(.*?)\}\}/g,function(e,r){return t[n][r]})}return res}
     
function init() {
    gapi.client.setApiKey("AIzaSyCNE3v4iPq_Z1wYrfg1Bh4SEWEDKBDOd0A");
    gapi.client.load("youtube", "v3", function() {
        // yt api is ready
	$('#youform').trigger("submit");	
    });
	
}	 

    $('#youform').on("submit",function(e) {
     var x="<?php echo $_GET['str']; ?>";
    	e.preventDefault();
       // prepare the request
       var request = gapi.client.youtube.search.list({
            part: "snippet",
            type: "video",
            q: encodeURIComponent(x).replace(/%20/g, "+"),
            maxResults: 10,
            order: "viewCount",
            publishedAfter: "2015-01-01T00:00:00Z"
       }); 
       // execute the request
       request.execute(function(response) {
          var results = response.result;
          $("#results").html("");
          $.each(results.items, function(index, item) {
            $.get("item.html", function(data) {
                $("#results").append(tplawesome(data, [{"title":item.snippet.title, "videoid":item.id.videoId}]));
			//	$(".video").css("width", $("#results").height() * 1.6/16);
				//$(".video").css("height", $("#results").width() * 4/16);
            });
          });
          resetVideoHeight();
       });
    });
	$(function() {
   $('#youform').trigger("submit");
});
	$(window).on("resize", resetVideoHeight);

function resetVideoHeight() {
    $(".video").css("height", $("#results").width() * 2.8/16);
}

		</script>
		<script src="https://apis.google.com/js/client.js?onload=init"></script> 
</body>
</html>