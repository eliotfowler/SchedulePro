$(document).ready(function(){
	
	$('#searchform').submit(function(e) {
		class_search();
		e.preventDefault();
		
	});
	
});

function class_search()
{
	//alert($("#search_text").val());
	//$("#results #sub_cont").load("test");
	//$("#results #sub_cont").load("class_search.php?val=" + $("#search_text").val() ,function() {
	//	alert("load worked");	
	//});
	
	var varjson = '{ "val" : "' + $("#search_text").val() + '" }';
	
	$.post("class_search.php", 
			{ val: varjson }, 
			function(ret) {
				alert(ret);
			}, "json");
	
}