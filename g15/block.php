<?php
session_start();
require '/lib/custom_query.php';
$blocker=$_SESSION['uname'];
$blocker_id = get_uid($blocker);
$blckd=$_GET['u'];
$blckd_id = get_uid($blckd);

		$res=block_user($blocker_id,$blckd_id);
		header("Location:blocked.php");
	
		?>
	