$(document).ready(function(){
	
	$('#searchform').submit(function(e) {
		class_search();
		e.preventDefault();
		
	});
	
});

function class_search()
{	
	alert($("#search_text").val());
	$.post("class_search.php", 
			{ val: $("#search_text").val() }, 
			function(ret) {
				create_table(ret);
			}, "json");
	
}

function create_table(jsonin) {
	var tbl = document.getElementById("class_list");
	var tblBody = document.createElement("tbody");
	
	for(i = 0; i < 5; i++)
	{
		var row = tbl.insertRow(i);
		
		for(j=0; j<6; j++)
		{
			var cell = row.insertCell(j);
			var cellText = document.createTextNode("cell is row "+j+", column "+i);
			cell.appendChild(cellText);
		}
		
	}	
	
}