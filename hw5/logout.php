<?php 
	include("include/util.php");
	session_start();
	session_destroy();
	session_regenerate_id(TRUE); 
	header("location:sign_in_form.php");
?>