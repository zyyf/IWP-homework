<?php 
	include("include/function.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Rancid Tomatoes</title>

		<meta charset="utf-8" />
		<link href="css/home.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		<div id="banner">
			<img src="images/rancidbanner.png" alt="Rancid Tomatoes" />
		</div>

		<h1>Movie reviews</h1>
		
<div id="content">
	<ul>
		<?php for($i=1;$i<=GET_COUNT("movie",$i);$i++) { ?>
			<li>
				<img src="images/<?= CHECK_RATE_TYPE(GET_MOVIE_INFO("rate",$i)) ?>large.png" alt="<?= CHECK_RATE_TYPE(GET_MOVIE_INFO("rate",$i)) ?>"/>
				<a class="link" href="movie.php?film=<?= $i ?>"><?= GET_MOVIE_INFO("name",$i) ?></a>
			</li>
		<?php } ?>
	</ul>
	
</div>
<div><p id="addlink" ><a class="link" href="add_movie_form.php?filmcount=<?= GET_COUNT("movie",0) ?>">Add a movie</a></p></div>



<div id="footer">
	 2015 &copy; Rancid Tomatoes <img src="images/fresh.gif" alt="Fresh" />
</div>
	
	</body>
</html>
