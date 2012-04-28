<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Your Schedule</title>
<style type="text/css">
.auto-style1 {
	background-image: url('images/calLeftSpacer.png');
	text-indent:40px; 

}

#tdDetail {
	border: solid 0 #000000; 
	border-left-width:2px;
	border-right-width:2px;
	padding-left:0.5ex;
}
</style>

<script type="text/javascript">
	function openWin(var1, var2, var3, var4, var5, var6, var7, var8, var9)
	{
		myWindow=window.open('','','width=300,height=200');
		myWindow.document.write(var1, var2, var3, var4, var5, var6, var7, var8, var9);
		myWindow.focus();
	}
</script>
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
	<table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td><img src="images/calTop.png"></td>
		</tr>
		<tr>
			<td>
				<table border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
					<tr>
						<td width="225" class="auto-style1" valign="top">
						<?php 
							echo date('g:ia', $classes[0][0][1]);
							//echo "<BR>\n&nbsp;<BR>\n&nbsp;<BR>\n&nbsp;<BR>\n&nbsp;<BR>\n&nbsp;";
							echo "\n<BR>\n<BR>\n<BR>\n<BR>\n";
							echo '<div>';
							echo date('g:ia', $classes[0][0][2] - 3600);
							echo '</div>';
							echo "\n<BR>\n";
							echo '<div>';
							echo date('g:ia', $classes[0][1][1]);
							echo '</div>';
							echo "\n<BR>\n<BR>\n";
							echo '<div>';
							echo date('g:ia', $classes[0][1][2]);
							echo '</div>';
							echo "\n<BR>\n";
							echo '<div>';
							echo date('g:ia', $classes[0][2][1]);
							echo '</div>';
							echo "\n<BR>\n<BR>\n";
							echo '<div>';
							echo date('g:ia', $classes[0][2][2]);
							echo '</div>';




						?>
						</td>
						<td style="width:128.5px"><div id="tdDetail">
						<?php
                                                        for($i=0; $i<4; $i++) {
                                                            $resource = mysql_query("SELECT * " .
                                                                                    "FROM meeting_times " .
                                                                                    "WHERE crn = '" . $classes[0][$i][0]['crn'] . "'");
                                                            while($row = mysql_fetch_assoc($resource)) {
                                                                if($row["day"] =='M') {
                                                                    //echo all stuff
                                                                    //echo '<table bgcolor="#0E76BC"><tr><td>';
                                                                    echo '<a href="javascript: void(0)" onClick="openWin(\'';
                                                                    echo $classes[0][$i][0]['dept_code'];
                                                                    echo '\', \'';
                                                                    echo $classes[0][$i][0]['course_number'];
                                                                    echo '<BR>\', \'';
                                                                    echo $classes[0][$i][0]['course_name'];
                                                                    echo '<BR>\', \'CRN: ';
                                                                    echo $classes[0][$i][0]['crn'];
                                                                    echo '<BR>\', \'Credit Hours: ';
                                                                    echo $classes[0][$i][0]['credit_hours'];
                                                                    echo '<BR>\', \'Section: ';
                                                                    echo $classes[0][$i][0]['section'];
                                                                    echo '<BR>\', \'Professor: ';
                                                                    echo $classes[0][$i][0]['professor'];
																	echo '<BR>\', \'Enrolled: ';
                                                                    echo $classes[0][$i][0]['act'];
                                                                    echo '<BR>\', \'Cap: ';
                                                                    echo $classes[0][$i][0]['cap'];


                                                                    echo '\')">';
                                                                    echo $classes[0][$i][0]['dept_code'] . " " . $classes[0][$i][0]['course_number'] . "<BR>";
                                                                    echo $classes[0][$i][0]['course_name'] . "<BR>";
                                                                    echo $classes[0][$i][0]['crn'] . "</a><BR>\n<BR>\n";
                                                                 }
                                                            }
                                                        }
						?>
						</div></td>
						<td style="width:127.5px"><div id="tdDetail">
                                                <?php
                                                        for($i=0; $i<4; $i++) {
                                                            $resource = mysql_query("SELECT * " .
                                                                                    "FROM meeting_times " .
                                                                                    "WHERE crn = '" . $classes[0][$i][0]['crn'] . "'");
                                                            while($row = mysql_fetch_assoc($resource)) {
                                                                if($row["day"] =='T') {
                                                                    //echo all stuff
                                                                    echo '&nbsp;\n<a href="javascript: void(0)" onClick="alert()>"';
                                                                    echo $classes[0][$i][0]['dept_code'] . " " . $classes[0][$i][0]['course_number'] . "<BR>";
                                                                    echo $classes[0][$i][0]['course_name'] . "<BR>";
                                                                    echo $classes[0][$i][0]['crn'] . "</a><BR>\n<BR>\n";
                                                                }
                                                            }
                                                        }
						?>
                                                    </div></td>
						<td style="width:128px"><div id="tdDetail">
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
                                                                    echo $classes[0][$i][0]['crn'] . "<BR>\n<BR>\n";
                                                                }
                                                            }
                                                        }
						?>
                                                        
                                                    </div></td>
						<td style="width:128px"><div id="tdDetail">
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
                                                                    echo $classes[0][$i][0]['crn'] . "<BR>\n<BR>\n";
                                                                }
                                                            }
                                                        }
						?>
                                                    </div></td>
						<td style="width:128px"><div id="tdDetail">
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
                                                                    echo $classes[0][$i][0]['crn'] . "<BR>\n<BR>\n";
                                                                }
                                                            }
                                                        }
						?>
                                                        
                                                    </div></td>
						<td style="width:127.5px"><div id="tdDetail">
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
                                                                    echo $classes[0][$i][0]['crn'] . "<BR>\n<BR>\n";
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
