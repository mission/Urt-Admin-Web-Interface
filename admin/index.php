<?php
define('INCLUDE_CHECK',true);
/*install database*/
$usrname = $_REQUEST['usr'];
$password = $_REQUEST['pass'];
$regip = $_REQUEST['ip'];
$usremail = $_REQUEST['email'];
$usrfullname = $_REQUEST['full'];

echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
</head>";
echo "<body><div align='center'>";
echo "<form action='installdb.php' method='post'>";
echo "<table><tr><td colspan='2'><font size='14'><strong>Admin Account</strong></font></td></tr>";
echo "<tr><td>Username:</td><td><input type='text' name='usr'></td></tr>";
echo "<tr><td>Password:</td><td><input type='password' name='pass'></td></tr>";
echo "<tr><td>Email:</td><td><input type='text' name='email'></td></tr>";
echo "<tr><td>Fullname:</td><td><input type='text' name='full'></td></tr>";
echo "<tr><td>regIP:</td><td><input type='text' name='ip'></td></tr>";
echo "<tr><td colspan='2'><input type='submit' name='saveusr' value='submit'></td></tr>";
echo "</table></form><br><font color='red'><strong>Note: regIP should be the ip of the Admin user, this will be used when ipcheck is turned on, if the persons ip doesnt match the ip on there account they will not beable to access the site for security reasons!</strong></font>";

echo "<br>";
if ($usrname != '') {
include("../classes/config_inc.php");
$link = mysql_connect("$db_host", "$db_user", "$db_pass") or die(mysql_error());
mysql_select_db($db_database, $link);
$sql = "INSERT INTO ".$db_prefix."_Users(usr,pass,email,regIP,fullname) values('".$usrname."', '".md5($password)."', '".$usremail."', '".$regip."', '".$usrfullname."');";
mysql_query($sql) or $dbusracc = "0";
if ($dbusracc == "0") {
	$dbusracc = "<font color='red'><strong>Failed: ".mysql_error()."</strong></font>";
} else {
	$dbusracc = "<font color='green'><strong>Success</strong></font>";
}
echo "<body><table><tr><td>Job:</td><td>Status</td></tr>";
echo "<tr><td>Create Admin Account:</td><td>".$dbusracc."<td></tr>";
echo "</table><br><br>";
}
echo "<br><br>Your IP: ".$_SERVER['REMOTE_ADDR']."</div></body></html>";

?>