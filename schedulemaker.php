<?php
ini_set('display_errors', 'Off');
error_reporting(E_ALL);

$con = mysql_connect("localhost","hackmu","hackpass");
mysql_select_db("hackmudb", $con);

//$JSONin = $_POST["preferences"];

$class_takeable = findTakeableClasses();
//$result = makeClassSchedule($class_takeable);
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
            
            //$con = mysql_connect("localhost","hackmu","hackpass");

            if (!$con){
                die('Could not connect: ' . mysql_error());
            }

            //mysql_select_db("hackmudb", $con);
            
            
            $user = "eliot";
            $major_reqs = array();
            $eliot_taken = array();
            $needs_to_take = array();
            $offered = array();
            $takeable_classes = array();
            $schedule = array();
            //echo $user . " is a computer science major. <br>";
            
            
            $resource = mysql_query("SELECT *" .
                                    "FROM computer_science_reqs");
            $prevID = -1;
            $prevTitle = null;
            while($row = mysql_fetch_assoc($resource)) {
                $major_reqs[$row['req_name']][] = array($row['req_id'], $row['dept_name'], $row['course_number']);
            }
            
            
            $resource = mysql_query("SELECT * " .
                                    "FROM " . $user. "_taken");
            
            while($row = mysql_fetch_assoc($resource)) {
               $eliot_taken[] = array($row['dept_name'], $row['course_number']);
                //echo $row['dept_name'] . " " . $row['course_number'] . "<br>";
            }
            //echo "eliot needs to take these classes: <br>";
            $needs_to_take = array();
            $temp_bool = false;
            $major_reqs_keys = array_keys($major_reqs);
            
            for($i=0; $i<count($major_reqs); $i++) {                
                for($j=0; $j<count($major_reqs[$major_reqs_keys[$i]]); $j++) {
                    $temp_bool = false;
                    $curclass = array($major_reqs[$major_reqs_keys[$i]][$j][1], $major_reqs[$major_reqs_keys[$i]][$j][2]);
                    for($k=0; $k<count($eliot_taken); $k++) {
                        if($eliot_taken[$k][0] == $curclass[0] && $eliot_taken[$k][1] == $curclass[1]) {
                            $temp_bool = true;
                        }
                        
                    }
                    $already_added = false;
                    if(!$temp_bool) {
                        for($k=0; $k<count($needs_to_take); $k++) {
                            if($needs_to_take[$k][0] == $curclass[0] && $needs_to_take[$k][1] == $curclass[1]) {
                                $already_added = true;
                            }
                        }
                        if(!$already_added){
                            $needs_to_take[] = $curclass;
                            //echo $curclass[0] . " " . $curclass[1] . "<br>";
                        }
                    }
                    
                    
                }
            }
            //echo "<br><br>These are the classes that are offered that you need to take: <br>";
            for($i=0; $i < count($needs_to_take); $i++) {
                $resource = mysql_query("SELECT dept_code, course_number " .
                                        "FROM classes " .
                                        "WHERE dept_code = '" . $needs_to_take[$i][0] . "' AND " . "course_number = '" . $needs_to_take[$i][1] . "'");
               
                $already_added = false;
                for($j=0; $j<count($offered); $j++){
                    if($offered[$j][0] == $needs_to_take[$i][0] && $offered[$j][1] == $needs_to_take[$i][1]) {
                        $already_added = true;
                    }
                }
                if(mysql_num_rows($resource) != 0 && !$already_added) {
                        $offered[] = array($needs_to_take[$i][0], $needs_to_take[$i][1]);
                        //echo $needs_to_take[$i][0] . " " . $needs_to_take[$i][1] . "<br>";
                    
                }
            }
            
           // var_dump($offered);
            
            //echo "Here are the classes that Eliot has taken the prereqs for, are being offered next semester, and still needs to take: <br>";
            for($i=0; $i<count($offered); $i++) {
                $cur_pre_reqs = array();
                $resource = mysql_query("SELECT pr_dept_code, pr_course_number " .
                                        "FROM pre_reqs " .
                                        "WHERE dept_code = '" . $offered[$i][0] . "' AND course_number = '" . $offered[$i][1] . "'");
                $prereq_death = false;
                while($row = mysql_fetch_assoc($resource)) {
                    //var_dump($row);
                    //echo "row is " . $row['pr_dept_code'] . " " . $row['pr_course_number'] . "<br>";
                    $has_prereqs = false;
                   // for($j=0; $j<count($row); $j++) {
                        for($k=0; $k<count($offered); $k++) {
                            //echo "offered is " . $offered[$k][0] . " " . $offered[$k][1] . "<br>";
                            //echo "row is " . $row['pr_dept_code'] . " " . $row['pr_course_number'] . "<br>";
                            if($row['pr_dept_code'] == $eliot_taken[$k][0] && $row['pr_course_number'] == $eliot_taken[$k][1]){
                                //echo "here <br>";
                                $has_prereqs = true;
                            }
                        }
                        if(!$has_prereqs) {
                            //echo "death <br>";
                            $prereq_death = true;
                        }
                        
                   // }
                }
                if(!$prereq_death){
                    $takeable_classes[] = array($offered[$i][0], $offered[$i][1]);
                    //echo $offered[$i][0] . " " . $offered[$i][1] . "<br>";
                }
            }
            
            
            //return $takeable_classes;//I now have takeable classes
            
            $classes = array();
        
            for($i=0; $i<count($takeable_classes); $i++) {
                //echo $takeable_classes[$i][0] . " " . $takeable_classes[$i][1] . "<br>";
                $resource = mysql_query("SELECT * " .
                                        "FROM classes " .
                                        "WHERE dept_code = '" . $takeable_classes[$i][0] . "' AND course_number = '" . $takeable_classes[$i][1] . "'");
                
                while($row = mysql_fetch_assoc($resource)) {
                    //var_dump($row);
                    //echo "<BR>";
                    $classes[] = $row;
                }
            }
            
          
            $sced_cred_hrs = 0;
            while($sced_cred_hrs < 12) {
                $lowest_cn = 999;
                $lowest_dept = "";
                //while($lowest_cn == 999) {
                
                    for($i=0; $i<count($classes); $i++) {
                        if($classes[$i]['course_number'] < $lowest_cn) {
                            $already_added = false;
                            for($j=0; $j<count($schedule); $j++) {
                                if(strcasecmp($schedule[$j][0]['dept_code'], $classes[$i]['dept_code']) == 0 && 
                                $schedule[$j][0]['course_number'] == $classes[$i]['course_number']) {
                                    $already_added = true;
                                }
                            }
                            if(!$already_added) {
                                $already_added_req = false;
                                //echo "We haven't added " . $classes[$i]['dept_code'] . " " . $classes[$i]['course_number'] . "<br>";
                                //echo "looking for req id from " . strtolower($classes[$i]['dept_code']) . " " . $classes[$i]['course_number'];
                                $query1 = mysql_query("SELECT req_id " .
                                                        "FROM computer_science_reqs " .
                                                        "WHERE dept_name = '" . $classes[$i]['dept_code'] . "' AND course_number = '" . $classes[$i]['course_number'] . "'");

                                $resource_row = mysql_fetch_assoc($query1);
                                for($j=0; $j<count($schedule); $j++) {
                                    $resource2 = mysql_query("SELECT req_id " .
                                                        "FROM computer_science_reqs " .
                                                        "WHERE dept_name = '" . $schedule[$j][0]['dept_code'] . "' AND course_number = '" . $schedule[$j][0]['course_number'] . "'");
                                    $resource2_row = mysql_fetch_assoc($resource2);
                                    //echo "<br>" . $resource_row['req_id'] . " " . $resource2_row['req_id'];
                                    if($resource_row['req_id'] == $resource2_row['req_id']) {
                                        //echo "turns out we already have a requirement for number " . $resource2_row['req_id'] . " which is the same as " . $resource_row['req_id'];
                                        $already_added_req = true;
                                        break;
                                    }
                                }
                                if(!$already_added_req) {
                                    $lowest_cn = $classes[$i]['course_number'];
                                    $lowest_dept = $classes[$i]['dept_code'];
                                }
                            }
                        }
                    }
               // }

                //echo $lowest_dept . " " . $lowest_cn;


                $possibilities = array();
                $earliest = 9999999999999;
                $earliest_end;
                $earliest_sdate;
                $earliest_edate;
                $earliest_crn;
                $earliest_dept;
                $earliest_cn;
                $earliest_sec;
                //$latest = -1;
                $already_added = false;
                for($i=0; $i<count($classes); $i++) {
                        if(strcasecmp($classes[$i]['dept_code'], $lowest_dept) == 0 && $classes[$i]['course_number'] == $lowest_cn) {
                            $resource = mysql_query("SELECT * " .
                                                    "FROM meeting_times " . 
                                                    "WHERE crn = '" . $classes[$i]['crn'] . "'" .
                                                    "ORDER BY 'start_time' ASC");

                            while($row = mysql_fetch_assoc($resource)) {
                                if(count($schedule) == 0)
                                {
                                    $earliest = $row['start_time'];
                                    $earliest_end = $row['end_time'];
                                    $earliest_sdate = $row['start_date'];
                                    $earliest_edate = $row['end_date'];
                                    $earliest_crn = $row['crn'];
                                }
                                for($j=0; $j<count($schedule); $j++) {
                                    if($row['start_time'] > $schedule[$j][0]['start_time'] && $row['start_time'] < $schedule[$j][0]['end_time']) {
                                       //bad 
                                    }
                                    else  {
                                        $earliest = $row['start_time'];
                                        $earliest_end = $row['end_time'];
                                        $earliest_sdate = $row['start_date'];
                                        $earliest_edate = $row['end_date'];
                                        $earliest_crn = $row['crn'];
                                    }
                                }
                                
                            }
                        }


                }

                for($i=0; $i<count($classes); $i++) {
                    if($classes[$i]['crn'] == $earliest_crn) {
                        $schedule[] = array($classes[$i], $earliest, $earliest_end, $earliest_sdate, $earliest_edate);
                        $earliest_cn = $classes[$i]['course_number'];
                        $earliest_dept = $classes[$i]['dept_code'];
                        $sced_cred_hrs += $classes[$i]['credit_hours'];
                    }
                }
                //echo $sced_cred_hrs;
            }
            
            //var_dump($schedule);
            return $schedule;
    }
	
	function findSchedule($classes) {
		
	}
    
?>
    </body>
</html>
