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
				test();
			}, "json");
	
}

function test() {
	// get the reference for the body
        var body = document.getElementsByTagName("body")[0];

        // creates a <table> element and a <tbody> element
        var tbl     = document.createElement("table");
        var tblBody = document.createElement("tbody");

        // creating all cells
        for (var j = 0; j < 2; j++) {
            // creates a table row
            var row = document.createElement("tr");

            for (var i = 0; i < 2; i++) {
                // Create a <td> element and a text node, make the text
                // node the contents of the <td>, and put the <td> at
                // the end of the table row
                var cell = document.createElement("td");
                var cellText = document.createTextNode("cell is row "+j+", column "+i);
                cell.appendChild(cellText);
                row.appendChild(cell);
            }

            // add the row to the end of the table body
            tblBody.appendChild(row);
        }

        // put the <tbody> in the <table>
        tbl.appendChild(tblBody);
        // appends <table> into <body>
        body.appendChild(tbl);
        // sets the border attribute of tbl to 2;
        tbl.setAttribute("border", "2");
}

function create_table(jsonin) {
	var tbl = document.getElementsById("class_list");
	var tblBody = document.createElement("tbody");
	
	for(i = 0; i < 5; i++)
	{
		var row = document.createElement("tr");
		
		for(j=0; j<6; j++)
		{
			var cell = document.createElement("td");
			var cellText = document.createTextNode("cell is row "+j+", column "+i);
			cell.appendChild(cellText);
			row.appendChild(cell);
		}
		
		tblBody.appendChild(row);
	}	
	
	tbl.appendChild(tblBody);
}