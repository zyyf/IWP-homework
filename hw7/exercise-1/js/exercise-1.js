"use strict";

window.onload = function() {

	// to save time :)
	function gebi(identifier) {
		return document.getElementById(identifier);
	}

	// add an error message as the new content of
	// the element 'tooltip'and make that element visible
	function on_failure(request) {
		tool.innerHTML = request.responseText;
		tool.style.visibility = "hidden";
	}

	// add the result of the AJAX request as the new content
	// of the element 'tooltip' and make that element visible
	function on_success(request) {
		tool.innerHTML = request.responseText;
		tool.style.visibility = "visible";
	}

	// empty the content of the element
	// of ID 'tooltip' and hide that element
	function tooltip_hide() {
		tool.innerHTML = "";
		tool.style.visibility = "hidden";
	}

	// do the AJAX request with the current selection and
	// * call 'on_success' after the request succeeded
	// * call 'on_failure' after the request failed
	function tooltip_show() {
		var selected = window.getSelection().getRangeAt(0);
		new SimpleAjax("dico.php","GET","word="+selected,on_success,on_failure);
	}

	// creates a new 'div' element with ID attribute
	// equal to 'tooltip', set the 'onclick' event on that
	// element to 'tooltip_hide' and add it as the new last
	// child of the body
	// finally set the 'ondblclick' event on the body to
	// 'tooltip_show'

	var tool = document.createElement("div");
	var mainbody = document.getElementsByTagName("body");
	tool.id = "tooltip";
	tool.onclick = tooltip_hide;
	mainbody[0].appendChild(tool);
	mainbody[0].ondblclick = tooltip_show;




};
