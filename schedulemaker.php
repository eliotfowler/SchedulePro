<?php
ini_set('display_errors', 'Off');
error_reporting(E_ALL);


//$JSONin = $_POST["preferences"];

findTakeableClasses();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Schedule Maker</title>
    </head>
    <body>
        <?
        function findTakeableClasses() {
            $user = "eliot";
            $major_reqs = array();
            $eliot_taken = array();
            $needs_to_take = array();
            echo $user . " is a computer science major. <br>";
            
            
            $con = mysql_connect("localhost","hackmu","hackpass");
            
            if (!$con){
                die('Could not connect: ' . mysql_error());
            }
            
            mysql_select_db("hackmudb", $con);
            
            echo "The computer science requirements are:";
            
            $resource = mysql_query("SELECT *" .
                                    "FROM computer_science_reqs");
            $prevID = -1;
            $prevTitle = null;
            while($row = mysql_fetch_assoc($resource)) {
                $major_reqs[$row['req_name']][] = array($row['req_id'], $row['dept_name'], $row['course_number']);
            }
            
            
            $resource = mysql_query("SELECT * " .
                                    "FROM " . $user. "_taken");
            
            //$coursesTaken = mysql_fetch_assoc($resource);
             //echo "<br><br>Eliot has taken the following: <BR>";
            while($row = mysql_fetch_assoc($resource)) {
               $eliot_taken[] = array($row['dept_name'], $row['course_number']);
               // echo $row['dept_name'] . " " . $row['course_number'] . "<br>";
            //}
            
            foreach($major_reqs as $key => $value) {
                var_dump($key);
            }
                
        }
    }
?>
    </body>
</html>
