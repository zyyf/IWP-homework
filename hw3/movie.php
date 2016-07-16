<!-- Name: ZhouyangYifan  
	 section: HW3-->
<?php 
	$movie_info = file(GET_DBPATH()."/".GET_MOVIE_NAME()."/info.txt",FILE_IGNORE_NEW_LINES);
	$overview_info = file(GET_DBPATH()."/".GET_MOVIE_NAME()."/overview.txt",FILE_IGNORE_NEW_LINES);
	function GET_MOVIE_NAME() {
		return $_GET["film"];
	}
	function GET_DBPATH() {
		return "moviedb";
	}
	function GET_FILE($file_name) {
		return file(GET_DBPATH()."/".GET_MOVIE_NAME()."/$file_name",FILE_IGNORE_NEW_LINES);
	}
	function CHECK_RATE_TYPE($ratenum) {                     //check the movie's comment is rotten or fresh
		if($ratenum < 60)
			return "rotten";
		else
			return "fresh";
	}
	function GET_OVERVIEW($line) {                           //get the overview text from overview.txt
		$overview_info = GET_FILE("overview.txt");
 		$overview = explode(":", $overview_info[$line]);
 		return $overview;
	}
	function GET_COMMENT_COUNT() {                           //get the number of comment
		return count(glob(GET_DBPATH()."/".GET_MOVIE_NAME()."/review*.txt"));
	}
	function GET_HALFNUM() {								//compute the div numbew
		$a = GET_COMMENT_COUNT();
		return ($a-$a%2)/2+($a%2);
	}
	function CHECK_COMMENT_TYPE($reviewnum) {				//check each comment's type(rotten or fresh)
		$a = GET_COMMENT_COUNT();
		if ($a>=10 && $reviewnum < 10)  				// tell the diffrence between "review01.txt" and "review1.txt"
			$b = "0";
		else
			$b = "";
		if (GET_FILE("review$b$reviewnum.txt")[1] === "ROTTEN")
			return "rotten";
		else
			return "fresh";
	}
	function GET_COMMENT($reviewnum) {           		//get the comment info from review file
		$a = GET_COMMENT_COUNT();
		if ($a>=10 && $reviewnum < 10)
			$b = "0";
		else
			$b = "";
		return GET_FILE("review$b$reviewnum.txt")[0];
	}
	function GET_COMMENT_USER($reviewnum) {				//get the info about the user of comment
		$a = GET_COMMENT_COUNT();
		if ($a>=10 && $reviewnum < 10)
			$b = "0";
		else
			$b = "";
		return GET_FILE("review$b$reviewnum.txt")[2];
	}
	function GET_COMMENT_WEBSITE($reviewnum) {			//get the info about the website of commenter user
		$a = GET_COMMENT_COUNT();
		if ($a>=10 && $reviewnum < 10)
			$b = "0";
		else
			$b = "";
		return GET_FILE("review$b$reviewnum.txt")[3];
	}


 	
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?= $movie_info[0] ?>  - Rancid Tomatoes</title>

		<meta charset="utf-8" />
		<link href="movie.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		<div id="banner">
			<img src="images/rancidbanner.png" alt="Rancid Tomatoes" />
		</div>

		<h1><?= $movie_info[0] ?> (<?= $movie_info[1] ?>)</h1>

		<a id="backbutton" href="home.html"><img src="images/goback.png" alt="gobackbutton" /></a>

		
		<div id="chief">
	   		<div id="right">
				<div>
					<img src="<?= GET_DBPATH() ?>/<?= GET_MOVIE_NAME() ?>/overview.png" alt="general overview" />
				</div>
				
				<dl>
					<?php for($i=1;$i<count($overview_info);$i++) { ?>
					<dt><?= GET_OVERVIEW($i)[0] ?></dt>
					<dd><?= GET_OVERVIEW($i)[1] ?></dd>
					<?php } ?>
				</dl>
			</div>   
	   		<div id="left">
				<div id="rate">
					<img src="images/<?= CHECK_RATE_TYPE($movie_info[2]) ?>large.png" alt="Rotten" />
					<span id="ratenum"><?= $movie_info[2] ?>%</span>
				</div>

				<div id="leftcomment">
					<?php for($i=1;$i<=GET_HALFNUM();$i++) { ?>
						<p class="comment">
							<img src="images/<?= CHECK_COMMENT_TYPE($i) ?>.gif" alt="<?= CHECK_COMMENT_TYPE($i) ?>" />
							<q><?= GET_COMMENT($i) ?></q>
						</p>
						<p class="user">
							<img src="images/critic.gif" alt="Critic" />
							<?= GET_COMMENT_USER($i) ?> <br />
							<?= GET_COMMENT_WEBSITE($i) ?>
						</p>
					<?php } ?>
				</div>

				<div id="rightcomment">
					<?php for($i=GET_HALFNUM()+1;$i<=GET_COMMENT_COUNT();$i++) { ?>
						<p class="comment">
							<img src="images/<?= CHECK_COMMENT_TYPE($i) ?>.gif" alt="<?= CHECK_COMMENT_TYPE($i) ?>" />
							<q><?= GET_COMMENT($i) ?></q>
						</p>
						<p class="user">
							<img src="images/critic.gif" alt="Critic" />
							<?= GET_COMMENT_USER($i) ?> <br />
							<?= GET_COMMENT_WEBSITE($i) ?>
						</p>
					<?php } ?>
				</div>
			</div>

			<p>(1-<?= GET_COMMENT_COUNT() ?>) of <?= GET_COMMENT_COUNT()?></p>
		</div>
  
	</body>
</html>
