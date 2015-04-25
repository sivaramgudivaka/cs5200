<!DOCTYPE >
<html lang="en">
    <head>		
        <title>YouTube+</title>
        <meta charset="UTF-8" />					
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Youtube+ videos" />
        <!--<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">-->
	 </head>
    <body onload="fn()">
        <div class="row">
            <div class="col-md-6 col-md-offset-3"  id="youtubesearch">
                <form id="youform" action="#">
                    <p><input type="text" id="search" placeholder="Type something..." autocomplete="off" class="form-control"></p>
                    <input type="submit" id="btn" value="Search" class="form-control btn btn-primary w100">
                </form>
                <div id="results"></div>
            </div>
        </div>
        <!-- scripts -->
		<script type="text/javascript">
        function fn()
		{
			document.getElementById("search").value = "<?php echo $_GET['str']; ?>";
		}
			
		</script>
		
		<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
		<script type= "text/javascript">
		jQuery(document).ready(function ($) {			
		$('#btn').click();});
		</script>
        <script src="js/app.js"></script>
				
        <script src="https://apis.google.com/js/client.js?onload=init"></script>
   
    </body>
</html>
