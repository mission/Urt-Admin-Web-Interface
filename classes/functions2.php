<?php



function getmod($side)
{

include("classes/config_inc.php");
$link = mysql_connect($db_host,$db_user,$db_pass) or die('Unable to establish a DB connection');
mysql_select_db($db_database,$link) or die("Unable to select $db_database database");
$sql = "SELECT * FROM `".$db_prefix."_modules` WHERE `pos`='$side' AND `status`='enabled' ORDER BY `order` ASC";
$result = mysql_query($sql);
if (!$result) {
echo "You should install some modules!<br>";
}
while ($data=mysql_fetch_assoc($result))
{
    $path = $data['file'];
	$container = $data['class'];
	$arg1 = $data['requiredarg1'];
	$arg2 = $data['requiredarg2'];
	$arg3 = $data['requiredarg3'];
	$out = explode('.', $path);
	$out = $out[0];
	$path = "modules/".$path."";
	$logcheck = $_SESSION['id'];
	if ($logcheck != "") {
		echo "<div class='$container'>";
		include_once($path);
		echo $out($arg1, $arg2, $arg3);
		echo "</div>";
		
		
	}
	
}
mysql_free_result($result);
}

function getadmin($uname)
{
$admin = $_SESSION['admin'];
if ($admin == "no") {
return false;
} else {
return true;
}
}


function getsinfo($server)
{
include("classes/config_inc.php");
$link = mysql_connect($db_host,$db_user,$db_pass) or die('Unable to establish a DB connection');
mysql_select_db($db_database,$link) or die("Unable to select ".$db_database." database");
$row = mysql_fetch_assoc(mysql_query("SELECT * FROM ".$db_prefix."_servers WHERE name=\"".$server."\""));
$sip = $row['ip'];
$sport = $row['port'];
$srcon = $row['rconpass'];
$sinfo = array("$sip", "$sport", "$srcon");
return $sinfo;
}

function getplist($sip, $sport, $srcon)
{
//$sinfo = getsinfo($sip, $sport, $srcon);
//include("q3rcon.php");
$r = new q3rcon("$sip", "$sport", "$srcon");
$players = $r->get_players();
return $players;
}

function getplist2($sip, $sport, $srcon)
{
$r = new q3rcon("$sip", "$sport", "$srcon");
$r->send_command("alphastatus");
$players = $r->get_response();
$players = explode("\n", $players);
return $players;
}


	