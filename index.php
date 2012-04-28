<?php
session_start();
session_regenerate_id();
if(isset($_SESSION['email'])) {
	header("Location: welcome.php");
}
if(!empty($_COOKIE['email'])) {
	$_SESSION['email'] = $_COOKIE['email'];
	header("Location: welcome.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>
			SchedulePro
		</title>
		<link rel="stylesheet" href="css/master.css" type="text/css" media="screen" title="no title" charset="utf-8">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js?ver=1.4.2"></script>
    	<script src="js/login.js"></script>
        <script type="text/javascript" src="js/register.js"></script>
	</head>
	<body style="margin:0px">
        <div id="fb-root"></div>
			<script>
             	window.fbAsyncInit = function() {
                FB.init({
                  appId      : '233879613383885', // App ID
                  channelUrl : 'http://www.schedulepro.eliotfowler.com/SchdeulePro/channel.html', // Channel File
                  status     : true, // check login status
                  cookie     : true, // enable cookies to allow the server to access the session
                  xfbml      : true  // parse XFBML
                });
            
                // Additional initialization code here
              };
            
              // Load the SDK Asynchronously
              (function(d){
                 var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
                 if (d.getElementById(id)) {return;}
                 js = d.createElement('script'); js.id = id; js.async = true;
                 js.src = "//connect.facebook.net/en_US/all.js";
                 ref.parentNode.insertBefore(js, ref);
               }(document));
            </script>
            <fb:login-button autologoutlink='true'  perms='email,user_birthday,status_update,publish_stream'></fb:login-button>
		<div id="middle">
			<div id="loginContainer">
            <a href="#" id="loginButton"><span>Login</span><em></em></a>
            <div style="clear:both"></div>
            <div id="loginBox">                
                <form id="loginForm" action="login2.php" method="post">
                    <fieldset id="body">
                        <fieldset>
                            <label for="login_name">Email</label>
                            <input type="text" name="login_name" id="login_name" />
                        </fieldset>
                        <fieldset>
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" />
                        </fieldset>
                        <input type="submit" id="submit" value="Login" />
                        <label for="remember"><input type="checkbox" id="remember" />Remember me</label>
                    </fieldset>
                    <span><a href="#">Forgot your password?</a></span>
                </form>
            </div>
        	</div>
            
           
            		
			<table id="index_reg" border="0" width="100%">
				<tr>
					<td><img src="images/spacer.png" height="270"></td>
				</tr>
				<tr>
					<td align="left">
						<img src="images/contentspacer.png" width="50">
					</td>
					<td width="100%">
						 <div id="div-regForm">

                <div class="form-title">Sign Up</div>
                	<div class="form-sub-title">It's free and only takes a few minutes</div>
                		<form id="regForm" action="register.php" method="post">
                
                			<table>
                 				<tbody>
                  					<tr>
                    					<td><label for="fname">First Name:</label></td>
                    					<td><div class="input-container"><input name="fname" id="fname" type="text" /></div></td>
                  					</tr>
                  					<tr>
                    					<td><label for="lname">Last Name:</label></td>
                    					<td><div class="input-container"><input name="lname" id="lname" type="text" /></div></td>
                  					</tr>
                  					<tr>
                    					<td><label for="email">Your Email:</label></td>
                    					<td><div class="input-container"><input name="email" id="email" type="text" /></div></td>
                  					</tr>
                 					<tr>
                                        <td><label for="pass">Password:</label></td>
                                        <td><div class="input-container"><input name="pass" id="pass" type="password" /></div></td>
                                    </tr>
                                    <tr>
                                        <td><label for="pass">Confirm Password:</label></td>
                                        <td><div class="input-container"><input name="pass2" id="pass2" type="password" /></div></td>
                                    </tr>
                  					<tr>
                    					<td><label>University:</label></td>
                    					<td>
                                            <div class="input-container">
                                            <select name="school" id="school">
                                            <option value="0">Please Select:</option>
                                            <option value="1">Miami University (Oxford)</option>
                                            </select>
                                            </div>
                                      	</td>
                					</tr>
                                    <tr>
                                    	<td>&nbsp;</td>
                                      	<td><input type="submit" class="greenButton" value="Sign Up" /><img id="loading" src="images/ajax-loader.gif" alt="working.." /></td>
                                    </tr>
                  
                  
                  			</tbody>
                		</table>
                
               		 </form>
                
                <div id="error">
                &nbsp;
                </div>
            </div>
					</td>

				</tr>

			</table>
		</div>	
	</body>
</html>
