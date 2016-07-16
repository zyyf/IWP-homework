<!-- Name: ZhouyangYifan  
	 section: HW3-->
<?php 
	include("include/function.php");
	$overview_info = file(GET_DBPATH()."/".GET_MOVIE_PATH()."/overview.txt",FILE_IGNORE_NEW_LINES);
	function GET_MOVIE_PATH() {
		return "movie".$_GET["film"];
	}
	function GET_FILE($file_name) {
		return file(GET_DBPATH()."/".GET_MOVIE_PATH()."/$file_name",FILE_IGNORE_NEW_LINES);
	}
	function GET_OVERVIEW($line) {                           //get the overview text from overview.txt
		$overview_info = GET_FILE("overview.txt");
 		$overview = explode(":", $overview_info[$line]);
 		return $overview;
	}
	function GET_COMMENT_COUNT() {                           //get the number of comment
		return count(glob(GET_DBPATH()."/".GET_MOVIE_PATH()."/review*.txt"));
	}
	function GET_HALFNUM() {								//compute the div numbew
		$a = GET_COMMENT_COUNT();
		return ($a-$a%2)/2+($a%2);
	}
	function CHECK_COMMENT_TYPE($reviewnum) {				//check each comment's type(rotten or fresh)
		if (GET_FILE("review$reviewnum.txt")[1] === "ROTTEN")
			return "rotten";
		else
			return "fresh";
	}
	function GET_COMMENT($reviewnum) {           		//get the comment info from review file
		return GET_FILE("review$reviewnum.txt");
	}


 	
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?= GET_MOVIE_INFO("name",$_GET["film"]) ?>  - Rancid Tomatoes</title>

		<meta charset="utf-8" />
		<link href="css/movie.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		<div id="banner">
			<img src="images/rancidbanner.png" alt="Rancid Tomatoes" />
		</div>

		<h1><?= GET_MOVIE_INFO("name",$_GET["film"]) ?> (<?= GET_MOVIE_INFO("year",$_GET["film"]) ?>)</h1>

		<a id="backbutton" href="home.php"><img src="images/goback.png" alt="gobackbutton" /></a>

		
		<div id="chief">
	   		<div id="right">
				<div>
					<img src="<?= GET_DBPATH() ?>/<?= GET_MOVIE_PATH() ?>/overview.png" alt="general overview" />
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
					<img src="images/<?= CHECK_RATE_TYPE(GET_MOVIE_INFO("rate",$_GET["film"])) ?>large.png" alt="<?= CHECK_RATE_TYPE(GET_MOVIE_INFO("rate",$_GET["film"])) ?>" />
					<span id="ratenum"><?= GET_MOVIE_INFO("rate",$_GET["film"]) ?>%</span>
				</div>

				<div id="leftcomment">
					<?php for($i=1;$i<=GET_HALFNUM();$i++) { ?>
						<p class="comment">
							<img src="images/<?= CHECK_COMMENT_TYPE($i) ?>.gif" alt="<?= CHECK_COMMENT_TYPE($i) ?>" />
							<q><?= GET_COMMENT($i)[0] ?></q>
						</p>
						<p class="user">
							<img src="images/critic.gif" alt="Critic" />
							<?= GET_COMMENT($i)[2] ?> <br />
							<?= GET_COMMENT($i)[3] ?>
						</p>
					<?php } ?>
				</div>

				<div id="rightcomment">
					<?php for($i=GET_HALFNUM()+1;$i<=GET_COMMENT_COUNT();$i++) { ?>
						<p class="comment">
							<img src="images/<?= CHECK_COMMENT_TYPE($i) ?>.gif" alt="<?= CHECK_COMMENT_TYPE($i) ?>" />
							<q><?= GET_COMMENT($i)[0] ?></q>
						</p>
						<p class="user">
							<img src="images/critic.gif" alt="Critic" />
							<?= GET_COMMENT($i)[2] ?> <br />
							<?= GET_COMMENT($i)[3] ?>
						</p>
					<?php } ?>
					
					<a class="addreview" href="add_review_form.php?movie=<?= $_GET["film"] ?>"><p class="addreview" >Add review</p></a>
					<!-- <p id="addreview"><a  href="add_review_form.php?movie=<?= $_GET["film"] ?>">Add review</a></p> -->


					

				</div>
			</div>

			<p>(1-<?= GET_COMMENT_COUNT() ?>) of <?= GET_COMMENT_COUNT()?></p>
		</div>
  
	</body>
</html>
