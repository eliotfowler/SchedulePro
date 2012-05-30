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
				alert(ret);
			}, "json");
	
}