<?php 
	include("include/util.php");
	session_start();
	


	if(isset($_POST["login"])) {
		if (file_exists(dbpath()."/".$_POST["login"])) {    //login is correct
			if ($_POST["password"] === get_password($_POST["login"])) {   //  password is correct
				$_SESSION["login"]=$_POST["login"];
				$_SESSION["maxnoteid"]=count(glob(dbpath()."/".$_SESSION["login"]."/notes/*"));
				header("location:notes.php");
			}
			else {
				header("location:error.php?type=login2");
			}
		}
		else {
			header("location:error.php?type=login1");
		}
	}
	
?>