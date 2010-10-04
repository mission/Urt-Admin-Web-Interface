<?php
define("INCLUDE_CHECK", true);
require_once("../modules/tsstatus/tsstatus.php");
include "../classes/config_inc.php";
$date = date('h:i:s a');
$link3 = mysql_connect($db_host,$db_user,$db_pass) or die('Unable to establish a DB connection');
mysql_select_db($db_database,$link3);
$result = mysql_query("select * from ".$db_prefix."_modules where `file`='ts3.php' and `status`='enabled';");
if(mysql_num_rows($result)==0){
 echo "There are 0 ts3 server viewers in the urtadmin_modules table<br>";
}

while($row = mysql_fetch_assoc($result))
{
	$host = $row['requiredarg1'];
	$port = $row['requiredarg2'];
	$vid  = $row['requiredarg3'];
	$tsstatus = new TSStatus($host, (int)$port, (int)$vid);
	$tsstatus->imagePath = "modules/tsstatus/img/";
	$tsstatus->showNicknameBox = false;
	$tsstatus->showPasswordBox = false;
	$tsstatus->decodeUTF8 = false;
	$tsstatus->timeout = 2;
	$result1 = mysql_query("select * from `".$db_prefix."_ts3` where (`ip`='".$host."' and `port`='".$port."') and `id`='".$vid."';");
	if(mysql_num_rows($result1)==0){
		$sql = "insert into `".$db_prefix."_ts3` values('".$host."','".$port."','".$vid."',\"".addslashes("<div class='container7'>".$tsstatus->render()."</div>")."\", \"$date\")";
		mysql_query($sql);
	} else {
		$sql = "update `".$db_prefix."_ts3` set `data`=\"".addslashes("<div class='container7'>".$tsstatus->render()."</div>")."\", `date`=\"$date\" where (`ip`='".$host."' and `port`='".$port."') and `id`='".$vid."';";
		mysql_query($sql);
	}

}
?>
