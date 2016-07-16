<link href="css/form.css" type="text/css" rel="stylesheet" />

<h1>Add a review for movie </h1>
		
<div id="content">
 
<form method="get" action="add_review.php">
	<div>Personal information</div>

	<label for="name">Name</label><input name="name" type="text" required="required"/><br />
	<label for="organization">Organization</label><input name="organization" type="text" required="required"/><br />
	
	<div>Your rating</div>
	
	<label><img src="images/fresh.gif" alt="Fresh" />FRESH <input type="radio" name="rating" value="FRESH" checked="checked" /></label>
  	<label><img src="images/rotten.gif" alt="Rotten" />ROTTEN <input type="radio" name="rating" value="ROTTEN" /></label>
  	
	<div>Your review</div>
	
	<textarea id="review" name="review" rows="10" cols="95" required="required"></textarea>
	<input type="hidden" name="film" value="<?= $_GET["movie"] ?>" />
	
	<div>
		<input id="submit" name="submit" type="submit" value="Submit" />
	</div>
</form>

</div>

<?php
	
?>
