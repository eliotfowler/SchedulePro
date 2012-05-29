$(".search").click(function(){
	//show the loading bar
	showLoader();
	$('#sub_cont').fadeIn(1500);
 
	$("#content #sub_cont").load("search.php?val=" + $("#search").val(), hideLoader());
 
});