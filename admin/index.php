<?php
/*
Urt Admin Web Interface

Developed By: |ALPHA|mission
Read the README.txt file for copyrite info

Version: 1.1
Version Date: Oct 4, 2010

*/

define("INCLUDE_CHECK", true);
include("../classes/config_inc.php");
include("classes/ipcheck.php");
include("classes/usrmgr.php");
include("classes/srvmgr.php");
include("classes/modmgr.php");
include("classes/menumgr.php");
include("classes/stylemgr.php");
include("classes/settingsmgr.php");
$userIP = $_SERVER['REMOTE_ADDR'];
$act = $_POST['action'];
$id = $_POST['entID'];
preg_match("/[^\.\/]+\.[^\.\/]+$/", $_SERVER['HTTP_HOST'], $matches);
$domain = $matches[0];
if ($CONFIG['ip_check'] == "On") {
	$c = new ipcheck;
	$c->checkip($userIP);
}
if (file_exists("add.php")) {
	die("add.php exists, you cannot access this site when this file exists, please create your user then delete/rename this file!");
}


// Those two files can be included only if INCLUDE_CHECK is defined


session_name('adminLogin');
// Starting the session

session_set_cookie_params(2*7*24*60*60);
// Making the cookie live for 2 weeks

session_start();

if($_SESSION['id'] && !isset($_COOKIE['urtAdmin_Remember']) && !$_SESSION['remember_Me'])
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
			$_SESSION['remember_Me'] = $_POST['remember_Me'];
			$_SESSION['timeout'] = time();
			$_SESSION['theme'] = $row['theme'];
			$oneyear = 60 * 60 * 24 * 365 + time(); 
			setcookie('currenttheme', $_SESSION['theme'], $oneyear); 
			// Store some data in the session
			
			setcookie('urtAdmin_Remember',$_POST['remember_Me']);
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
<title><?php echo $CONFIG['title'];?></title>
<!--[if !IE 6]><!--><link rel="stylesheet" type="text/css" href="admin.css" /><!--<![endif]-->
</head>
<body>
<?php
if (!$_SESSION['id']) {
	echo "<div align='center' valign='center'>";
	echo '<form class="clearfix" action="" method="post">';
		echo '<h1>Administrator Login</h1>';
			
		if($_SESSION['msg']['login-err'])
		{
			echo '<div class="err">'.$_SESSION['msg']['login-err'].'</div>';
			unset($_SESSION['msg']['login-err']);
		}
		echo '<table class="container3"><tr><td>';
		echo '<label class="grey" for="username">Username:</label></td><td>';
		echo '<input class="field" type="text" name="username" id="username" value="" size="23" /></td></tr><tr><td>';
		echo '<label class="grey" for="password">Password:</label></td><td>';
		echo '<input class="field" type="password" name="password" id="password" size="23" /></td></tr><tr><td>';
		echo '<label>Remember me</label></td><td><input name="remember_Me" id="remember_Me" type="checkbox" checked="checked" value="1" /></td></tr><tr><td colspan="2">';
		echo '<input type="submit" name="submit" value="Login" class="nav" /></td></tr>';
		echo '</table>';
	echo '</form>';
	echo "</div>";
} else {
echo "<div align='center'>";
echo "<table class='container3'><tr><td><div align='center'>";
echo "<table>";
echo "<tr><td><a href='../'><button class='nav'>Home</button></a></td><td><form action='' method='post'><button type='submit' class='nav' name='action' value='usrmgr'>User Manager</button></td><td><button type='submit' name='action' class='nav' value='srvmgr'>Server Manager</button></td><td><button type='submit' class='nav' name='action' value='modmgr'>Module Manager</button></td><td><button type='submit' class='nav' name='action' value='menumgr'>Menu Manager</button></td><td><button type='submit' class='nav' name='action' value='stylemgr'>Style Manager</button></td><td><button type='submit' class='nav' name='action' value='settingsmgr'>Settings Manager</button></form></td></tr>";
echo "</table><br><br><br>";

if ($act != '') {
	echo $act($id);
}
echo "<br><br><br><br><a href='?logoff'>Logout</a><br><br>Your IP: {$_SERVER['REMOTE_ADDR']}</div></td></tr></table></div>";
}
echo "<br><br><div align='center'><font color='white'>{$domain}, Powered by UrtAdmin Web Interface v1.1</font></div>";
?>
</body>
</html>
