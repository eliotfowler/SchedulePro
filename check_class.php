<?php
require_once "includes/config.php";

$check = mysql_query("SELECT * FROM users WHERE email = '". $_SESSION['email'] ."'");
$user_info = mysql_fetch_array( $check );
$fname = $user_info['fname'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Schedule Pro - Check Class</title>
<link rel="stylesheet" href="css/master.css" type="text/css" media="screen" title="no title" charset="utf-8">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script> 
<script src="js/custom.js"></script>
</head>
<body>
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
<div id="checkclass-container">
    	
        <div id="check-main">
        	<form class="form-wrapper cf">
				<input type="text" placeholder="Search here..." required>
				<button type="submit">Search</button>
			</form>
        </div>
</div>
        
</body>
</html>