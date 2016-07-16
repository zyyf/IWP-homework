
// to distinguish between the first
// click and the second click of two
// consecutive clicks
var first_click = true;

// the first image clicked
var first_image;

// if not_finished is true, there
// are still images to swao
var not_finished = true;

// process the click on the image
function click_on(image) {
	if (!is_finished()) {
		if (first_click) {
			first_image = image;
		}
		else {
			var a;
			a = image.src;
			image.src = first_image.src;
			first_image.src = a;

			a = image.name;
			image.name = first_image.name;
			first_image.name = a;

			is_finished();
		}
		first_click = !first_click;
	}
}

// returns true if the puzzle is solved
function is_finished() {
	var image = document.getElementsByTagName("img");
	for (var i=1;i<=11;i++)
		if (image[i].name>image[i+1].name)
			return false;
	var notice = document.getElementById("result");
	notice.style.visibility = "visible";
	return true;
}
