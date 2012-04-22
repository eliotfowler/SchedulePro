<?php
        
        $JSONin = $_POST["preferences"];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?
        function findTakeableClasses() {
            $user = "eliot";
            $con = mysql_connect("localhost","hackmu","hackpass");
            
            if (!$con){
                die('Could not connect: ' . mysql_error());
            }
            
            mysql_select_db("hackmudb", $con);
            
            $resource = mysql_query("SELECT dept_name AND course_number " .
                                    "FROM" . $user . "_taken ");
            
            //$coursesTaken = mysql_fetch_assoc($resource);
            
            while($row = mysql_fetch_assoc($resource)) {
                var_dump($row);
            }
        }
        ?>
    </body>
</html>
