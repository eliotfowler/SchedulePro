<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
	$reqFields = 3;	// How many rows
	$groupFields = 8;	// Must be increments of 4
	$orFields = 8;	// Must be increments of 4

	// Connects to your Database 
	mysql_connect("localhost", "hackmu", "hackpass") or die(mysql_error()); 
	mysql_select_db("hackmudb") or die(mysql_error()); 
	
	//checks cookies to make sure they are logged in 
	if(isset($_COOKIE['ID_my_site'])) 
	{ 
		$username = $_COOKIE['ID_my_site']; 
		$pass = $_COOKIE['Key_my_site']; 
		$check = mysql_query("SELECT * FROM users WHERE username = '$username'")or die(mysql_error()); 
		while($info = mysql_fetch_array( $check )) 
		{ 
			
			//if the cookie has the wrong password, they are taken to the login page 
			if ($pass != $info['password']) 
			{
				header("Location: login.php"); 
			}

			//otherwise they are shown the admin area 
			else
			{
?>
<title>SchedulePro - <?php echo $_COOKIE['ID_my_site']; ?></title>
<style type="text/css">
.auto-style1 {
	border-style: solid;
	border-width: 1px;
}
</style>
</head>
<body>
	<?php //$id = isset($_GET['id']) ? $_GET['id'] : 1; ?>
	<h1>Creat your course requirements <?php echo $_COOKIE['ID_my_site']; ?>!</h1>
	<br>
	<form action="addclasses.php" method="post">
	<h3>Required Courses</h3>
		<table border="1">
		<?php
			$elementCounter = 0;
			for($i = 0; $i<$reqFields; $i++;)
			{
				if($i == 0)
				{
					//header row
					echo "<tr>\n";
						echo '<td>Course</td>';
						echo '<td>Course #</td>';
						echo '<td>&nbsp;</td>';
						echo '<td>Course</td>';
						echo '<td>Course #</td>';
						echo '<td>&nbsp;</td>';
						echo '<td>Course</td>';
						echo '<td>Course #</td>';
						echo '<td>&nbsp;</td>';
						echo '<td>Course</td>';
						echo '<td>Course #</td>';
					echo "</tr>\n";
				}
				echo "<tr>\n";
					for($j = 0; $j < 4; $i++)
					{
						echo "<td><input type=\"text\" name\=\"A_course" . $elementCounter . "\" maxlength\=\"5\" size\=\"6\"><\/td>\n";
						echo "<td><input type=\"text\" name\=\"A_crs_num" . $elementCounter . "\"maxlength\=\"5\" size\=\"6\"><\/td>\n";
						echo "<td>\&nbsp\;<\/td>\n";
						$elementCounter++;
					}
				echo "</tr>\n";
			}
		?>
			<tr>
				<td>Course</td>
				<td>Course #</td>
				<td>&nbsp;</td>
				<td>Course</td>
				<td>Course #</td>
			</tr>
			<tr>
				<td><input type="text" name="A1_course01" maxlength="5" size="6"></td>
				<td><input type="text" name="A1_crs_num01" maxlength="5" size="6"></td>
				<td>&nbsp;</td>
				<td><input type="text" name="A1_course02" maxlength="5" size="6"></td>
				<td><input type="text" name="A1_crs_num02" maxlength="5" size="6"></td>
			</tr>
			<tr>
				<td><input type="text" name="A1_course03" maxlength="5" size="6"></td>
				<td><input type="text" name="A1_crs_num03" maxlength="5" size="6"></td>
				<td>&nbsp;</td>
				<td><input type="text" name="A1_course04" maxlength="5" size="6"></td>
				<td><input type="text" name="A1_crs_num04" maxlength="5" size="6"></td>
			</tr>

		</table>
		<br>
		<h3>Group of Courses with required credit hours</h3>
		<br>
		Required credit hours needed for this group: <input type="text" name="B1_cred_hours" maxlength="2" size="3">
		<table border="1">
			<tr>
				<td>Course</td>
				<td>Course #</td>
				<td>&nbsp;</td>
				<td>Course</td>
				<td>Course #</td>
			</tr>
			<tr>
				<td><input type="text" name="B1_course01" maxlength="5" size="6"></td>
				<td><input type="text" name="B1_crs_num01" maxlength="5" size="6"></td>
				<td>&nbsp;</td>
				<td><input type="text" name="B1_course02" maxlength="5" size="6"></td>
				<td><input type="text" name="B1_crs_num02" maxlength="5" size="6"></td>
			</tr>
			<tr>
				<td><input type="text" name="B1_course03" maxlength="5" size="6"></td>
				<td><input type="text" name="B1_crs_num03" maxlength="5" size="6"></td>
				<td>&nbsp;</td>
				<td><input type="text" name="B1_course04" maxlength="5" size="6"></td>
				<td><input type="text" name="B1_crs_num04" maxlength="5" size="6"></td>
			</tr>
		</table>
	</form>
						
						
						
						<a href="logout.php">Logout</a>
	<?php
					
			}
		}
	}
	else //if the cookie does not exist, they are taken to the login screen 
	{ 
		header("Location: index.php");
	}
?>

</body>
</html>