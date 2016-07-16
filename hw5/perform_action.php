<?php
	session_start();
	include("include/util.php");
		
	if ( isset($_POST["delete_note"])) {
		include("delete_note.php");
	}
	else {
		include("add_todo.php");
	}
	// header("Location: notes.php");
?>