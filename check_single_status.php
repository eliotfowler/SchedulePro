<?php
mysql_connect("localhost", "hackmu", "hackpass") or die(mysql_error()); 
mysql_select_db("hackmudb") or die(mysql_error()); 

$file=fopen("/var/www/SchedulePro/cse_list","r");
while(!feof($file))
  {
    $line = split(",",fgets($file));
        if($line[2] - $line[1] <= 0) {
            //mysql_query("INSERT INTO watch_list (uid, crn) VALUES (19, $line[0])");
			echo "user 19 wants to watch the class with crn " . $line[0] . "<br>";
        }
  }
fclose($file);

?>
