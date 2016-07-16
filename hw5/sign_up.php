<?php 
	include ("include/util.php");
	session_start();
	mkdir(dbpath()."/".$_POST["login"]);
	mkdir(dbpath()."/".$_POST["login"]."/notes");
	file_put_contents(dbpath()."/".$_POST["login"]."/info.txt", $_POST["password"]."\n");
	file_put_contents(dbpath()."/".$_POST["login"]."/info.txt", $_POST["firstname"]."\n", FILE_APPEND);
	file_put_contents(dbpath()."/".$_POST["login"]."/info.txt", $_POST["lastname"]."\n", FILE_APPEND);
	header("location:sign_in_form.php");
?>