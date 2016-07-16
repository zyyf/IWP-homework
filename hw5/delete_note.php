<?php 
	unlink(dbpath()."/".$_SESSION["login"]."/notes/".$_POST["todo_id"]);
	header("Location: notes.php");
?>