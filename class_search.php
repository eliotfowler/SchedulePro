<?php include "config.php";

$postVal = $_POST['val'];
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

$check = mysql_query("SELECT * 
					  FROM classes, meeting_times
					  WHERE dept_code = '" . $input[0] . "' AND course_number = '" . $input[1] . "' 
					  		AND classes.crn = meeting_times.crn") or die(mysql_error());
							
$rows = mysql_fetch_assoc( $check );

echo json_encode($input[0]);
//echo json_encode($rows);