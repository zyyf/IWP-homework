<?php 
	include("include/util.php");
	session_start();
	if (!isset($_SESSION["login"])) {
		header("location:error.php?type=nologin");
	}
?>



<!DOCTYPE html>
<html>
	<head>
		<title>2DO</title>
		<meta charset="utf-8" />
		<link href="css/main.css" type="text/css" rel="stylesheet" />
	</head>
	<body>

		<a id="logout" href="logout.php">
			<input class="button" type="button" value="Logout" />
		</a>

		<div id="top_banner">
			<form method="post" action="add_note.php">
				<div>
					<span class="left">
						<?= get_name($_SESSION["login"]) ?>'s
						<span id="logo">2DO</span>
						notes
					</span>
				</div>
				<div class="right">
					<input class="button right" type="submit" value="Add note" title="add a new note"/>
					<input class="right" type="text" name="note_title" />
					<div>Enter the title of your new note here</div>
				</div>
			</form>
		</div>

		<div id="content">
			<?php
				// trim_notes(); 
				$i=0;
				// while (file_exists(dbpath()."/".$_SESSION["login"]."/notes/$i")) { 
				while (isset(get_notelist()[$i])) {
			?>
			<form class="list left" action="perform_action.php" method="post">
				<input type="hidden" name="todo_id" value="<?= get_notelist()[$i] ?>" />
				<div class="note_title" title="<?= get_date(get_notelist()[$i]) ?>">
					<?= get_title(get_notelist()[$i]) ?>
					<input class="button right" type="submit" name="delete_note" value="X" title="delete this note" />
				</div>
				<ul>
					<li>
						<span class="todo"></span>
					</li>
					<?php for ($j=2; $j < count(get_note(get_notelist()[$i])); $j++) { ?>
						<li>
							<span class="todo"><?= get_note(get_notelist()[$i])[$j] ?></span>
						</li>
					<?php } ?>
				</ul>
				<div>
					<input class ='left text_input' type="text" name="new_todo" />
					<input class ='right button' type="submit" name="add_todo" value="+" title="add a todo"/>
				</div>
			</form>
			<?php $i++; } ?>


	
			

		</div>
	</body>
</html>