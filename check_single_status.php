<?php include("mailtest.php");


echo exec('whoami'); 
/*
$file=fopen("/var/www/SchedulePro/CSE_List.txt","r");
while(!feof($file))
  {
    $line = split(",",fgets($file));
    if($line[0] == 59428) {
        if($line[2] - $line[1] == 1) {
            //send();
        }
    }
  }
fclose($file);
*/
?>
