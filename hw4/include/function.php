<?php 
	
	function GET_DBPATH() {
		return "moviedb";
	}
	function CHECK_RATE_TYPE($ratenum) {                     //check the movie's comment is rotten or fresh
		if($ratenum < 60)
			return "rotten";
		else
			return "fresh";
	}
	function GET_COUNT($type,$filmnum) {
		if ($type === "review")
			return count(glob(GET_DBPATH()."/movie$filmnum/review*.txt"));
		else if ($type === "movie") 
			return count(glob(GET_DBPATH()."/movie*/"));	
	}
	function GET_MOVIE_INFO($type,$filmnum) {
		if ($type === "name") 
			return file(GET_DBPATH()."/movie$filmnum/info.txt",FILE_IGNORE_NEW_LINES)[0];
		elseif ($type === "year")
			return file(GET_DBPATH()."/movie$filmnum/info.txt",FILE_IGNORE_NEW_LINES)[1];
		elseif ($type === "rate")
			return file(GET_DBPATH()."/movie$filmnum/info.txt",FILE_IGNORE_NEW_LINES)[2];

	}
?>