$(document).ready(function(){
	
	$('#searchform').submit(function(e) {

		class_search();
		e.preventDefault();
		
	});
	
});

function class_search()
{
	$("#results #sub_cont").load("class_search.php?val=" + $("#search_text").val(), hideLoader());
	
}