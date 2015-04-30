<?php
session_start();
include '/lib/db_connect.php';
include '/lib/Playlist.php';
include '/lib/Plstfiles.php';
$u = $_SESSION['uname'];
$uid = $_SESSION['uid'];
$m = $_GET['m'];
$pname = $_GET['p'];
$plst_obj = new Playlist;
$plst_obj->__set('uid', $uid);
$plst_obj->__set('pname', $pname);
$plst_dao = new PlaylistDAO;
$result = $plst_dao->get_playlist_by_name($plst_obj);
$row = mysqli_fetch_array($result);
$pid = $row['PId'];
$plstf_obj = new Plstfiles;
$plstf_obj->__set('pid', $pid);
$plstf_obj->__set('mediaid', $m);
$plstf_dao = new PlstfilesDAO;
$plstf_dao->insert_into_playlist($plstf_obj);
?>