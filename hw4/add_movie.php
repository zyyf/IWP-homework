<?php 
	include("include/function.php");
	$filmcount = $_POST["film_count"];
	$filmcount++;
	if(is_uploaded_file($_FILES["info"]["tmp_name"])) {
		mkdir(GET_DBPATH()."/movie$filmcount");
		move_uploaded_file($_FILES["info"]["tmp_name"], GET_DBPATH()."/movie$filmcount/info.txt");
	}
	if(is_uploaded_file($_FILES["overview"]["tmp_name"]))
		move_uploaded_file($_FILES["overview"]["tmp_name"], GET_DBPATH()."/movie$filmcount/overview.txt");
	if(is_uploaded_file($_FILES["image"]["tmp_name"]))
		move_uploaded_file($_FILES["image"]["tmp_name"], GET_DBPATH()."/movie$filmcount/overview.png");

	$i=1;
	while (is_uploaded_file($_FILES["review$i"]["tmp_name"])) {
		move_uploaded_file($_FILES["review$i"]["tmp_name"], GET_DBPATH()."/movie$filmcount/review$i.txt");
		$i++;
	}
	header("location:home.php");
?>