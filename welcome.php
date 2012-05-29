<?php
require_once "includes/config.php";

$check = mysql_query("SELECT * FROM users WHERE email = '". $_SESSION['email'] ."'");
$user_info = mysql_fetch_array( $check );
$fname = $user_info['fname'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>
			SchedulePro
		</title>
		<link rel="stylesheet" href="css/master.css" type="text/css" media="screen" title="no title" charset="utf-8">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script> 
        <script src="js/custom.js"></script>
	</head>
	<body style="margin:0px">
    <div id="welcome-container">
    	<div id=userDashboard>
        	<div id="settings">
                <a href="#" class="button">
                    <span class="txt">Settings</span>
                    <span class="ar">&#9660;</span>
                </a>
                <div class="menu">
                    <ul>
                        <li><a href="check_single_status.php">Account Settings</a></li>
                        <li><a href="includes/logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
            <div id="name">
            	<?php echo "Hello, " . $user_info['fname'] . " " . $user_info['lname']; ?>
            </div>
        </div>
		<div id="welcomeM">
		<table border="0" width="100%">
				<tr>
					<td><img src="images/welcomeTopSpacer.png"></td>
				</tr>
				<tr>
					<td align="left">
						<img src="images/welcomeLeftSpacer.png">
					</td>
					<td width="100%">
                    
					<a href="calendar.php" onMouseOver="document.quickSchedule.src='images/quickScheduleB.png';" onMouseOut="document.quickSchedule.src='images/quickSchedule.png';">
 <img src="images/quickSchedule.png" name="quickSchedule" width="219" height="212" border="0"></a>
 
 <a href="" onMouseOver="document.customSchedule.src='images/customScheduleB.png';" onMouseOut="document.customSchedule.src='images/customSchedule.png';">
 <img src="images/customSchedule.png" name="customSchedule" border="0"></a>
					</td>
				</tr>
				<tr>
					<td align="left">
						<img src="images/contentspacer.png">
					</td>
					<td>
						<table border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td><a href="check_single_status.php" id="class_status" onMouseOver="document.classStatus.src='images/classStatusB.png';" onMouseOut="document.classStatus.src='images/classStatus.png';">
<img src="images/classStatus.png" name="classStatus" border="0" ></a></td>						
							</tr>
							<tr>
								<td><a href="" onMouseOver="document.currentSchedule.src='images/currentScheduleB.png';" onMouseOut="document.currentSchedule.src='images/currentSchedule.png';">
<img src="images/currentSchedule.png" name="currentSchedule" border="0"></a></td>
							</tr>
							<tr>
								<td><a href="" onMouseOver="document.classHistory.src='images/classHistoryB.png';" onMouseOut="document.classHistory.src='images/classHistory.png';">
<img src="images/classHistory.png" name="classHistory" border="0"></a></td>
							</tr>						
						</table>
					</td>

				</tr>

			</table>

		</div>
		</div>
	</body>
</html>
