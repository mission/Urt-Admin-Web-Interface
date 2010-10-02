<?php
/*
Urt Admin Web Interface

Developed By: |ALPHA|mission
Read the README.txt file for copyrite info

Version: 1.0
Version Date: Oct 1, 2010

*/
preg_match("/[^\.\/]+\.[^\.\/]+$/", $_SERVER['HTTP_HOST'], $matches);
$domain = $matches[0];
define('INCLUDE_CHECK',true);
require("classes/ipcheck.php");
require 'classes/functions.php';
require 'classes/functions2.php';
require 'classes/q3status.php';
require 'classes/q3rcon.php';
require 'classes/config_inc.php';
$userIP = $_SERVER['REMOTE_ADDR'];

if ($ipcheckon == "on") {
$c = new ipcheck;
$c->checkip($userIP);
}

// Those two files can be included only if INCLUDE_CHECK is defined


session_name('Login');
// Starting the session

session_set_cookie_params(2*7*24*60*60);
// Making the cookie live for 2 weeks

session_start();
$theme = $_REQUEST['settheme'];
if ($theme != '') {
	$_SESSION['theme'] = $theme;
	$dblink = mysql_connect($db_host,$db_user,$db_pass) or die('Unable to establish a DB connection');
	mysql_select_db($db_database, $dblink);
	$query = "update `".$db_table."` set `theme`=\"".$theme."\" where `id`='".$_SESSION['id']."'";
	mysql_query($query);
	$oneyear = 60 * 60 * 24 * 365 + time(); 
	setcookie('currenttheme', $_SESSION['theme'], $oneyear); 			
}

if($_SESSION['id'] && !isset($_COOKIE['urtAdminRemember']) && !$_SESSION['rememberMe'])
{
	// If you are logged in, but you don't have the tzRemember cookie (browser restart)
	// and you have not checked the rememberMe checkbox:

	$_SESSION = array();
	session_destroy();
	
	// Destroy the session
}


if(isset($_GET['logoff']))
{
	$_SESSION = array();
	session_destroy();
	
	header("Location: index.php");
	exit;
}

if($_POST['submit']=='Login')
{
	// Checking whether the Login form has been submitted
	
	$err = array();
	// Will hold our errors
	
	
	if(!$_POST['username'] || !$_POST['password'])
		$err[] = 'All the fields must be filled in!';
	
	if(!count($err))
	{
		$_POST['username'] = mysql_real_escape_string($_POST['username']);
		$_POST['password'] = mysql_real_escape_string($_POST['password']);
		$_POST['rememberMe'] = (int)$_POST['rememberMe'];
		
		// Escaping all input data

		$row = mysql_fetch_assoc(mysql_query("SELECT id,usr,admin,fullname,theme FROM ".$db_table." WHERE usr='{$_POST['username']}' AND pass='".md5($_POST['password'])."'"));

		if($row['usr'])
		{
			// If everything is OK login
			
			$_SESSION['usr']=$row['usr'];
			$_SESSION['id'] = $row['id'];
			$_SESSION['admin'] = $row['admin'];
			$_SESSION['userName'] = $row['usr'];
			$_SESSION['password'] = $row['password'];
			$_SESSION['userFull'] = $row['fullname'];
			$_SESSION['userIP'] = $row['ipaddress'];
			$_SESSION['userRole'] = $row['userRole'];
			$_SESSION['rememberMe'] = $_POST['rememberMe'];
			$_SESSION['timeout'] = time();
			$_SESSION['theme'] = $row['theme'];
			$oneyear = 60 * 60 * 24 * 365 + time(); 
			setcookie('currenttheme', $_SESSION['theme'], $oneyear); 
			// Store some data in the session
			
			setcookie('urtAdminRemember',$_POST['rememberMe']);
		}
		else $err[]='Wrong username and/or password!';
	}
	
	if($err)
	$_SESSION['msg']['login-err'] = implode('<br />',$err);
	// Save the error messages in the session

	header("Location: index.php");
	exit;
}


$script = '';

if($_SESSION['msg'])
{
	// The script below shows the sliding panel on page load
	
	$script = '
	<script type="text/javascript">
	
		$(function(){
		
			$("div#panel").show();
			$("#toggle a").toggle();
		});
	
	</script>';
	
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title;?></title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <?php include "classes/head.php" ?>
    <?php echo $script; ?>
    <!-- PNG FIX for IE6 -->
    <!-- http://24ways.org/2007/supersleight-transparent-png-in-ie6 -->
    <!--[if lte IE 6]>
        <script type="text/javascript" src="login_panel/js/pngfix/supersleight-min.js"></script>
    <![endif]-->
    
    <script src="login_panel/js/slide.js" type="text/javascript"></script>
    
</head>

<body class='flexcroll'>

<!-- Panel -->
<div id="toppanel">
	<div id="panel">
		<div class="content clearfix">
			<div class="left">
			<?php echo getmod(news); ?>
			</div>
            
            
            <?php
			
			if(!$_SESSION['id']):
			
			?>
            
			<div class="left">
				<!-- Login Form -->
				<form class="clearfix" action="" method="post">
					<h1>Administrator Login</h1>
                    
                    <?php
						
						if($_SESSION['msg']['login-err'])
						{
							echo '<div class="err">'.$_SESSION['msg']['login-err'].'</div>';
							unset($_SESSION['msg']['login-err']);
						}
					?>
					
					<label class="grey" for="username">Username:</label>
					<input class="field" type="text" name="username" id="username" value="" size="23" />
					<label class="grey" for="password">Password:</label>
					<input class="field" type="password" name="password" id="password" size="23" />
	            	<label><input name="rememberMe" id="rememberMe" type="checkbox" checked="checked" value="1" /> &nbsp;Remember me</label>
        			<div class="clear"></div>
					<input type="submit" name="submit" value="Login" class="bt_login" />
				</form>
			</div>
			<div class="left right">			
                    <?php
						if ($_SESSION['id']) {
							echo getmod(reg);
						}
					?>
			</div>
            
            <?php
			
			else:
			
			?>
            
            <div class="left">
            
            <h1>Administrators panel</h1>

            <a href="?logoff">Log off</a>
            
            </div>
            
            <div class="left right">
			<?php
			if ($_SESSION['id']) {
				echo getmod(admin);
			}?>
            </div>
            
            <?php
			endif;
			?>
		</div>
	</div> <!-- /login -->	

    <!-- The tab on top -->	
	<div class="tab">
		<ul class="login">
	    	<li class="left">&nbsp;</li>
	        <li>Hello <?php echo $_SESSION['userFull'] ? $_SESSION['userFull'] : 'Guest';?>!</li>
			<li class="sep">|</li>
			<li id="toggle">
				<a id="open" class="open" href="#"><?php echo $_SESSION['id']?'Open Panel':'Log In | Register';?></a>
				<a id="close" style="display: none;" class="close" href="#">Close Panel</a>			
			</li>
	    	<li class="right">&nbsp;</li>
		</ul> 
	</div> <!-- / top -->
	
</div> <!--panel -->

<div class="pageContent">
	<div id="main">
	<?php
	if ($_SESSION['id']) {
		echo "<table><tr><td valign='top' width='15%'>";
		//left panel content
		echo getmod(left);
		echo "</td><td valign='top'>
			  <div class='container2'>
			  <br><br></div>
			  <div class='container3'>
				<h1>".$header1."</h1>
				<h2>".$subhead."</h2>
				</div>";
		//body content
		echo getmod(body);
		
		// User Content;
		echo "<table><tr><td valign='top' width='28.3%'>";
		echo getmod(user1);
		echo"</td><td valign='top' width='28.3%'>";
		echo getmod(user2);
		echo "</td><td valign='top' width='28.3%'>";
		echo getmod(user3);
		echo "</td></tr></table>";
				
		//footer
		echo getmod(footer);
		
		echo "</td></tr></table>";
		if($_SESSION['admin'] == 'Yes') {
			echo "<br><br><div align='center'><a href='admin/'><button class='nav'>Admin Backend</button></a></div>";
		}
		echo "<br><br><div align='center'><font color='white'>{$domain}, Powered by UrtAdmin Web Interface v1.0</font></div>";
		} else {
		echo "<div class='container'><div align='center'><h1>You need to login to view this site!<h1></div></div>";
	}
	?>
	</div>
</div>

</body>
</html>