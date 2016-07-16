<?php 
 	include("include/function.php");
 	$adding=GET_COUNT("review",$_GET["film"])+1;

	if(($_GET["review"]===" ")||($_GET["name"]===" ")||($_GET["organization"]===" ")) {
		header("location:add_review_error.php?film=".$_GET["film"]);
	}
	else {
		file_put_contents(GET_DBPATH()."/movie".$_GET["film"]."/review$adding.txt", $_GET["review"]."\n");
		file_put_contents(GET_DBPATH()."/movie".$_GET["film"]."/review$adding.txt", $_GET["rating"]."\n", FILE_APPEND);
		file_put_contents(GET_DBPATH()."/movie".$_GET["film"]."/review$adding.txt", $_GET["name"]."\n", FILE_APPEND);
		file_put_contents(GET_DBPATH()."/movie".$_GET["film"]."/review$adding.txt", $_GET["organization"], FILE_APPEND);
		header("location:movie.php?film=".$_GET["film"]);
	}

?>