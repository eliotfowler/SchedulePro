<?php include "includes/config.php";

//$postVal = $_POST['val'];
$postVal = "ACC 221";
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
					  WHERE classes.crn = meeting_times.crn limit 25");
					  //classes.dept_code = '" . strtoupper($input[0]) . "' AND classes.course_number = '" . $input[1] . "' 
					  //		AND 
							
if(!$check) {
	echo "bad";	
}

$rows = mysql_fetch_assoc( $check );

var_dump($rows);

//echo json_encode($input[0]);
//echo json_encode($rows);