<?php
session_start();
require '/lib/custom_query.php';
$con = connect();
$u=$_SESSION['uname'];
$uid = get_uid($u);
$com=$_GET['q'];
$m=$_GET['m'];
$com=mysqli_real_escape_string($con,$com);
create_comment($uid, $m, $com);
echo $com;

?>