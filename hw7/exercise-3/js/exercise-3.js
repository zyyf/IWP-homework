"use strict";

window.onload = function() {
	
	// to save time :)
	function gebi(id) {
		return document.getElementById(id);
	}
	
	// trim, convert in lower-case all letters but the first
	// of the string name and return the new string
	function normalize(name) {
		var first_last = name.split(" ");
		var first = first_last[0];
		var last = first_last[1];
		first = first.toLowerCase();
		first = first.toUpperCase().split("")[0] + first.substring(1);
		last = last.toLowerCase();
		last = last.toUpperCase().split("")[0] + last.substring(1);
		// console.log(first.toUpperCase().split("")[0]);
		// console.log(first[0]);
		return first+" "+last;
	}

	// save the current list of participants on the server
	// using an Ajax request
	function save() {
		var date = new Date();
		var li = document.querySelectorAll("li");
		
		var list = [];
		for (var i = 0; i < li.length; i++) {
			var listsingle = {};
			listsingle.gender = li[i].getAttribute("class");
			listsingle.name = li[i].innerHTML;
			list.push(listsingle);
		}
		
		new SimpleAjax("save.php","POST","date="+date+"&list="+JSON.stringify(list));
	}
	
	// remove a participant from the list
	function remove() {
		// var kuang = document.createElement("div");
		// var text = document.createElement("p");
		if (confirm("Delete it?")) {
			var list = document.getElementsByTagName("ol");
			list[0].removeChild(this);
			save();
		}
	}
	
	// add a new participant to the list
	function add() {
		var name = gebi("firstname").value+" "+gebi("lastname").value;
		var genders = document.getElementsByName("gender");
		if (genders[0].getAttribute("checked") == "checked") {
			var gender = "male";
		}
		else {
			var gender = "female";
		}
		var newli = document.createElement("li");
		newli.setAttribute("class",gender);
		newli.innerHTML = normalize(name);
		newli.onclick = remove;
		var list = document.getElementsByTagName("ol");
		list[0].appendChild(newli);
		save();
	}
	
	// unobstrusive JavaScript!
	
	document.querySelector("section#new > input").onclick = add;
	var lis = document.querySelectorAll("#list li");
	for ( var i = 0; i < lis.length; i++ ) {
		lis[i].onclick = remove;
	}
};
