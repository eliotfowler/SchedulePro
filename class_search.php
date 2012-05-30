<?php include "includes/config.php";

$postVal = $_POST['val'];
//$postVal = "com 135";
$safe = checkValues($postVal);
$input = explode(" ", $safe);

function checkValues($value)
{
	 // Use this function on all those values where you want to check for both sql injection and cross site scripting
	 //Trim the value
	 $value = trim($value);
	 
	// Stripslashes
	if (get_magic_quotes_gpc()) {
		$value = stripslashes($value);
	}
	
	 // Convert all &lt;, &gt; etc. to normal html and then strip these
	 $value = strtr($value,array_flip(get_html_translation_table(HTML_ENTITIES)));
	
	 // Strip HTML Tags
	 $value = strip_tags($value);
	
	return $value;
	
}

$query1 = mysql_query("SELECT crn 
					  FROM classes
					  WHERE classes.dept_code = '" . strtoupper($input[0]) . "' AND classes.course_number = '" . $input[1] . "' limit 25");

while($row = mysql_fetch_assoc( $query1 )) {
	$crns[] = $row;	
}

var_dump($crns);

$query2 = mysql_query("SELECT * 
					  FROM classes, meeting_times
					  WHERE classes.dept_code = '" . strtoupper($input[0]) . "' AND classes.course_number = '" . $input[1] . "' 
					  		AND classes.crn = meeting_times.crn limit 25");
					  
							
if(!$query1) {
	echo "bad";	
}

while($row = mysql_fetch_assoc( $query2 )) {
	$result[] = $row;	
}


//echo json_encode($result);