<?php

define('INCLUDE_CHECK',true);
require("classes/ipcheck.php");
require 'classes/functions.php';
require 'classes/functions2.php';
require 'classes/q3status.php';
require 'classes/q3rcon.php';
require 'classes/config_inc.php';
$userIP = $_SERVER['REMOTE_ADDR'];

if ($CONFIG['ip_check'] == "On") {
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



?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title;?></title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <?php include "classes/head.php" ?>
    
</head>

<body class='flexcroll'>

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
			  <div class='utilcontainer6'>
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
		echo "</td></table>";
	} else {
		echo "<div align='center'><table class='container'><tr><td>";
		echo "<div align='center' valign='center'>";
		echo '<form class="clearfix" action="" method="post">';
		echo '<h1>Administrator Login</h1>';
		if($_SESSION['msg']['login-err'])
		{
			echo '<div class="err">'.$_SESSION['msg']['login-err'].'</div>';
			unset($_SESSION['msg']['login-err']);
		}
		echo '<table class="srvcontainer"><tr><td>';
		echo '<label class="grey" for="username">Username:</label></td><td>';
		echo '<input class="field" type="text" name="username" id="username" value="" size="23" /></td></tr><tr><td>';
		echo '<label class="grey" for="password">Password:</label></td><td>';
		echo '<input class="field" type="password" name="password" id="password" size="23" /></td></tr><tr><td>';
		echo '<label>Remember me</label></td><td><input name="remember_Me" id="remember_Me" type="checkbox" checked="checked" value="1" /></td></tr><tr><td colspan="2">';
		echo '<input type="submit" name="submit" value="Login" class="bt_login" /></td></tr>';
		echo '</table>';
		echo '</form>';
		echo "</div>";
		echo "</table></div>";
	}
	?>
	</div>
</div>

</body>
</html>
