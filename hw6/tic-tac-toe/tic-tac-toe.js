// the grid is 3x3
var size = 3;

// if grid[i][j] == -1, the cell (i,j) is empty, else grid[i][j]
// is the player number who ticked that cell (0 or 1)
var grid = [[-1, -1, -1], [-1, -1, -1], [-1, -1, -1]];

// the name of the players
var player_name = ["", ""];

// the image for each player
var player_image = ["O.png", "X.png"];

// the current player
var current_player = 0;

// the total number of clicks
var clicks = 0;

// if play is false, the clicks are disabled
var play = false;

// return the other player
function next(player) {
	return (player + 1) % 2;
}

// checks if the player filled the row
function winning_row(player, row) {
	if ((grid[row][0] == player) && (grid[row][1] == player) && (grid[row][2] == player))
		return true;
	else
		return false;
}

// checks if the player filled the column
function winning_column(player, column) {
	if ((grid[0][column] == player) && (grid[1][column] == player) && (grid[2][column] == player))
		return true;
	else
		return false;
}

// checks if the player filled the downward diagonal
function winning_diagonal_down(player) {
	if ((grid[0][0] == player) && (grid[1][1] == player) && (grid[2][2] == player))
		return true;
	else
		return false;
}

// checks if the player filled the upward diagonal
function winning_diagonal_up(player) {
	if ((grid[0][2] == player) && (grid[1][1] == player) && (grid[2][0] == player))
		return true;
	else
		return false;
}

// checks if the player filled one of the two diagonals
function winning_diagonal(player) {
	if (winning_diagonal_up(player) || winning_diagonal_down(player))
		return true;
	else
		return false;
}

// checks if the player filled a row, a coloumn or a diagonal
function is_winner(player) {
	if (winning_diagonal(player))
		return true;
	else 
		if (!winning_diagonal(player)) {
		for (var i=0;i<3;i++)
			if (winning_row(player,i) || winning_column(player,i))
				return true;
	}
	else
		return false;
}

// display the result about the winner
function and_the_winner_is(player) {
	msg("The winner is "+player_name[current_player]+" !");
}

// process the click on the object image
// in the cell (row,column) in the grid,
function click_at(row, column, image) {
	if (play) {
		grid[row][column] = current_player;
		image.src = player_image[current_player];
		clicks++;
		if (is_winner(current_player)) {
			play = false;
			and_the_winner_is(current_player);
			final = document.getElementById('final');
			final.style.visibility = "visible";
		}
		else {
			current_player = next(current_player);
			msg(player_name[current_player]+" is playing...");
		}
	}
}

// display a message in the element of ID "msg"
function msg(message) {
	mesg = document.getElementById('msg');
	mesg.innerHTML = message;
}

// set the name of the players
function set_players() {
	var player1 = document.getElementById('player1');
	player_name[0] = player1.value;
	var player2 = document.getElementById('player2');
	player_name[1] = player2.value;

	var span1 = document.getElementById('first_player');
	var span2 = document.getElementById('second_player');
	span1.innerHTML = player_name[0];
	span2.innerHTML = player_name[1];

	var startmenu = document.getElementById('start');
	startmenu.style.visibility = "visible";
}

// allow the game to start
function start_game() {
	// if (!current_player) {					//第一个人在玩
	// 	if (!is_winner(current_player)) {
	// 	}
	// }
	player_check = document.getElementById('check_second');
	if (player_check.checked)
		current_player = 1;
	else
		current_player = 0;
	msg(player_name[current_player]+" is playing...");
	play = true;
}

// process the play-again action
function play_again() {
	for (var i=0;i<3;i++)
		for (var j=0;j<3;j++)
			grid[i][j] = -1;
	var gridimage = document.getElementsByTagName('img');
	for (var i=2;i<11;i++)
		gridimage[i].src = "white.png";
	msg("");

	var player1 = document.getElementById('player1');
	player1.value = "";
	var player2 = document.getElementById('player2');
	player2.value = "";
	var startmenu = document.getElementById('start');
	startmenu.style.visibility = "hidden";

	var final = document.getElementById('final');
	final.style.visibility = "hidden";
}

// process the quit action
function quit() {
	window.location.href = "../index.php";
}

