<?php
	include("include/util.php");
	session_start();
	if (empty(trim($_POST["note_title"]))) {
		header("Location:error.php?type=note");
	}
	else {
		$note_title = $_POST["note_title"];
		$date = "Created ". date("Y-m-d h:i a");
		$notes = glob(dbpath()."/".$_SESSION["login"]."/notes/*");
		$note_num = count($notes)-1;
		$last_note_num = note_id($notes[$note_num]);
		$new_note = $last_note_num+1;
		file_put_contents(dbpath()."/".$_SESSION["login"]."/notes/$new_note", 
			"$note_title\n$date\n");
		header("Location: notes.php");
	}
?>