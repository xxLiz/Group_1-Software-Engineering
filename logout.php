<?php
	require "DatabaseConnection.php";
	session_start();
	
	$_SESSION = array();
	
	session_destroy();

	/* redirect to login.php */
	header("Location: login.php");
	exit;
?>
