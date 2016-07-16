<?php

# returns the relative path of the database folder
function dbpath() {
	return "2doDB";
}

# returns the first name of the user of login $login
function get_name($login) {
	return file(dbpath()."/$login/info.txt",FILE_IGNORE_NEW_LINES)[1];
}

# extract the note id (a number) from the file path
# of the file. For example, note_id("2doDB/marc/notes/3") returns "3"
function note_id($note_file) {
	return explode("/", $note_file)[3];
}

# returns the title of the $note array
function get_title($note) {
	return get_note($note)[0];
}

# returns the date of the $note array
function get_date($note) {
  	return get_note($note)[1];
}

function get_password($login) {
	return file(dbpath()."/$login/info.txt",FILE_IGNORE_NEW_LINES)[0];
}

function get_note($note) {
	return file(dbpath()."/".$_SESSION["login"]."/notes/$note",FILE_IGNORE_NEW_LINES);
}

function get_notelist() {
	$notes = glob(dbpath()."/".$_SESSION["login"]."/notes/*");
	$i=0;
	while (isset($notes[$i])) {
		$notes[$i] = note_id($notes[$i]);
		$i++;
	}
	return $notes;
}

// function trim_notes() {
// 	$notelist = glob(dbpath()."/".$_SESSION["login"]."/notes/*");
// 	$i=0;
// 	while (isset($notelist[$i])) {
// 		rename(dbpath()."/".$_SESSION["login"]."/notes/".note_id($notelist[$i]), dbpath()."/".$_SESSION["login"]."/notes/".$i+1);
// 		$i++;
// 	}
// }

?>
