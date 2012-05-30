$(document).ready(function(){
	
	$('#searchform').submit(function(e) {
		class_search();
		e.preventDefault();
		
	});
	
});

function class_search()
{	
	$.post("class_search.php", 
			{ val: $("#search_text").val() }, 
			function(ret) {
				create_table(ret);
			}, "json");
	
}

function create_table(jsonin) {
	var tbl = document.getElementById("class_list");
	var tblBody = document.createElement("tbody");
	
	for(i = 1; i < 5; i++)
	{
		var row = tbl.insertRow(i);
		
		var cell0 = row.insertCell(0);
		var cellText0 = jsonin[i].crn;
		cell0.appendChild(cellText0);
		
		var cell1 = row.insertCell(1);
		var cellText1 = jsonin[i].crn;
		cell1.appendChild(cellText1);
		
		var cell2 = row.insertCell(2);
		var cellText2 = jsonin[i].crn;
		cell2.appendChild(cellText2);
		
		var cell0 = row.insertCell(0);
		var cellText0 = jsonin[i].crn;
		cell0.appendChild(cellText0);
		
		var cell0 = row.insertCell(0);
		var cellText0 = jsonin[i].crn;
		cell0.appendChild(cellText0);
		
		var cell0 = row.insertCell(0);
		var cellText0 = jsonin[i].crn;
		cell0.appendChild(cellText0);
		
		var cell0 = row.insertCell(0);
		var cellText0 = jsonin[i].crn;
		cell0.appendChild(cellText0);
		
	}	
	
}