<?php
echo "This video is blocked. You do not have permissions to watch this video. Sorry!";
echo "Redirecting to <a href=\"index.php\">Home page!</a>";
header( "refresh:2;url=index.php" );
?>