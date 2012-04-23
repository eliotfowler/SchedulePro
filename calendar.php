<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Untitled 1</title>
</head>
<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
include("schedulemaker.php");
	$classes[] = findTakeableClasses();
	//var_dump($classes);
	//var_dump($classes[0][0][0]['credit_hours']);
        $con = mysql_connect("localhost","hackmu","hackpass");

        if (!$con){
            die('Could not connect: ' . mysql_error());
        }

        mysql_select_db("hackmudb", $con);
?>

<body style="margin:0px" bgcolor="#D1D2D4">
	<table border="2" cellpadding="0" cellspacing="0">
		<tr>
			<td><img src="images/calTop.png"></td>
		</tr>
		<tr>
			<td>
				<table border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
					<tr>
						<td align="left"><img src="images/calLeftSpacer.png" width="225" height="1"></td>
						<td style="width:127.5px"><div style="border: solid 0 #060; border-left-width:2px; padding-left:0.5ex; padding-right:0.5ex">
						<?php
                                                        for($i=0; $i<4; $i++) {
                                                            $resource = mysql_query("SELECT * " .
                                                                                    "FROM meeting_times " .
                                                                                    "WHERE crn = '" . $classes[0][$i][0]['crn'] . "'");
                                                            while($row = mysql_fetch_assoc($resource)) {
                                                                if($row["day"] =='M') {
                                                                    //echo all stuff
                                                                    echo $classes[0][$i][0]['dept_code'] . " " . $classes[0][$i][0]['course_number'] . "<BR>";
                                                                    echo $classes[0][$i][0]['course_name'] . "<BR>";
                                                                    echo $classes[0][$i][0]['crn'] . "<BR>";
                                                                }
                                                            }
                                                        }
						?>
						</div></td>
						<td style="width:127.5px"><div style="border: solid 0 #060; border-left-width:2px; padding-left:0.5ex">
                                                <?php
                                                        for($i=0; $i<4; $i++) {
                                                            $resource = mysql_query("SELECT * " .
                                                                                    "FROM meeting_times " .
                                                                                    "WHERE crn = '" . $classes[0][$i][0]['crn'] . "'");
                                                            while($row = mysql_fetch_assoc($resource)) {
                                                                if($row["day"] =='T') {
                                                                    //echo all stuff
                                                                    echo $classes[0][$i][0]['dept_code'] . " " . $classes[0][$i][0]['course_number'] . "<BR>";
                                                                    echo $classes[0][$i][0]['course_name'] . "<BR>";
                                                                    echo $classes[0][$i][0]['crn'] . "<BR>";
                                                                }
                                                            }
                                                        }
						?>
                                                    </div></td>
						<td style="width:127.5px"><div style="border: solid 0 #060; border-left-width:2px; padding-left:0.5ex">
                                                 <?php
                                                        for($i=0; $i<4; $i++) {
                                                            $resource = mysql_query("SELECT * " .
                                                                                    "FROM meeting_times " .
                                                                                    "WHERE crn = '" . $classes[0][$i][0]['crn'] . "'");
                                                            while($row = mysql_fetch_assoc($resource)) {
                                                                if($row["day"] =='W') {
                                                                    //echo all stuff
                                                                    echo $classes[0][$i][0]['dept_code'] . " " . $classes[0][$i][0]['course_number'] . "<BR>";
                                                                    echo $classes[0][$i][0]['course_name'] . "<BR>";
                                                                    echo $classes[0][$i][0]['crn'] . "<BR>";
                                                                }
                                                            }
                                                        }
						?>
                                                        
                                                    </div></td>
						<td style="width:128px"><div style="border: solid 0 #060; border-left-width:2px; padding-left:0.5ex">
                                                <?php
                                                        for($i=0; $i<4; $i++) {
                                                            $resource = mysql_query("SELECT * " .
                                                                                    "FROM meeting_times " .
                                                                                    "WHERE crn = '" . $classes[0][$i][0]['crn'] . "'");
                                                            while($row = mysql_fetch_assoc($resource)) {
                                                                if($row["day"] =='R') {
                                                                    //echo all stuff
                                                                    echo $classes[0][$i][0]['dept_code'] . " " . $classes[0][$i][0]['course_number'] . "<BR>";
                                                                    echo $classes[0][$i][0]['course_name'] . "<BR>";
                                                                    echo $classes[0][$i][0]['crn'] . "<BR>";
                                                                }
                                                            }
                                                        }
						?>
                                                    </div></td>
						<td style="width:128px"><div style="border: solid 0 #060; border-left-width:2px; padding-left:0.5ex">
                                                        <?php
                                                        for($i=0; $i<4; $i++) {
                                                            $resource = mysql_query("SELECT * " .
                                                                                    "FROM meeting_times " .
                                                                                    "WHERE crn = '" . $classes[0][$i][0]['crn'] . "'");
                                                            while($row = mysql_fetch_assoc($resource)) {
                                                                if($row["day"] =='F') {
                                                                    //echo all stuff
                                                                    echo $classes[0][$i][0]['dept_code'] . " " . $classes[0][$i][0]['course_number'] . "<BR>";
                                                                    echo $classes[0][$i][0]['course_name'] . "<BR>";
                                                                    echo $classes[0][$i][0]['crn'] . "<BR>";
                                                                }
                                                            }
                                                        }
						?>
                                                        
                                                    </div></td>
						<td style="width:127.5px"><div style="border: solid 0 #060; border-left-width:2px; padding-left:0.5ex">
                                                        <?php
                                                        for($i=0; $i<4; $i++) {
                                                            $resource = mysql_query("SELECT * " .
                                                                                    "FROM meeting_times " .
                                                                                    "WHERE crn = '" . $classes[0][$i][0]['crn'] . "'");
                                                            while($row = mysql_fetch_assoc($resource)) {
                                                                if($row["day"] =='S') {
                                                                    //echo all stuff
                                                                    echo $classes[0][$i][0]['dept_code'] . " " . $classes[0][$i][0]['course_number'] . "<BR>";
                                                                    echo $classes[0][$i][0]['course_name'] . "<BR>";
                                                                    echo $classes[0][$i][0]['crn'] . "<BR>";
                                                                }
                                                            }
                                                        }
						?>
                                                    </div></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td><img src="images/calBottom.png"></td>
		</tr>

		
	</table>
</body>

</html>
