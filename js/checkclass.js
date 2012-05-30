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
	for(i = 0; i < 5; i++)
	{
		alert(jsonin[i].crn);
	}	
}