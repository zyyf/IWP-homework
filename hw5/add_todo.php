<?php 
	if (empty(trim($_POST["new_todo"]))) {
		header("location:error.php?type=todo");
	}
	else {
		file_put_contents(dbpath()."/".$_SESSION["login"]."/notes/".$_POST["todo_id"], "\n".$_POST["new_todo"], FILE_APPEND);
		header("Location: notes.php");
	}
?>