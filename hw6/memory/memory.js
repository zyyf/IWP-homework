"use strict";

// if the image is turning to hidden
var is_loading = false;


// the array of the path of the images
var array = [];

// if clicked[i] is true, array[i] is visible
var clicked = [];

// to distinguish between the first
// click and the second click of two
// consecutive clicks
var first_click = true;

// the index in the array of the first image clicked
var first_index = 0;

// the total number of pairs of clicks
var clicks_number = 0;

// the number of good pairs of clicks
// (i.e. clicks which revealed two identical images)
var good_clicks_number = 0;

// change the content of the attribute src of the two
// images at index i and j to the question mark image
function hide(i, j) {
	var pic = document.getElementsByTagName('img');
	pic[i].src = "question-mark.png";
	pic[j].src = "question-mark.png";
	is_loading = false;
}

// process the click on image at index n
function click_image(n) {
	var pic = document.getElementsByTagName('img');
	if (first_click && (good_clicks_number != 8) && (!is_loading)) {
		pic[n].src = array[n];
		first_index = n;
		clicked[n] = true;
		first_click = false;
	} else if ((good_clicks_number != 8) && (!is_loading) && (n != first_index)) {
		pic[n].src = array[n];
		clicks_number++;
		if (array[n] == array[first_index]) {
			good_clicks_number++;
			clicked[n] = true;
			if (good_clicks_number == 8) {
				var msg = document.getElementById('result');
				msg.innerHTML = "You finished the game!<br />You guess the image " + clicks_number + " times."
				msg.style.visibility = "visible";
			}
		} else {
			clicked[first_index] = false;
			is_loading = true;
			setTimeout(hide, 1000, n, first_index);
		}
		first_click = true;
	}
	console.log(good_clicks_number);
}

// fill the array with the content of the name
// attribute of the images
function fill_array() {
	var paths = document.getElementsByTagName('img');
	for (var i = 0; i < 16; i++)
		array[i] = paths[i].name;
}

// to fill the array before the game starts
window.onload = fill_array;

// test unobtrusive javascript code
// window.onload = check_click;
// function check_click() {
// 	var image = document.getElementsByTagName('img');
// 	for (var i=0;i<16;i++) {
// 		image[i].onclick=click_image	;
// 	}
// }