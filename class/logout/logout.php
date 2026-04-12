<?php
	session_start();

require_once "../config/config.php";
	$h_desc = 'logout';
	$h_tbl = 'user';
	$sessionid = $_SESSION['admin_id'];
	$sessiontype = $_SESSION['admin_type'];

	$sql = $conn->prepare('UPDATE user SET online_stats = ? WHERE id = ?;
						   UPDATE member SET online_stats = ? WHERE id = ?');
	$sql->execute(array(0,$sessionid,0,$sessionid));
	session_destroy();
	header('Location: ../../index');
?>