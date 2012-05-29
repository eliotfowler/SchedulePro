<?php include "config.php";

$safe = checkValues($_GET['val']);
echo $safe;
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
	
	// Quote the value
	$value = mysql_real_escape_string($value);
	return $value;
	
}




var_dump($input[0]);
//echo $input[0];
//echo "hi";
return $input[0];