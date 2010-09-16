<?php
require_once("tsstatus/tsstatus.php");
$tsstatus = new TSStatus("alphaclan.net", 10011, 1);
$tsstatus->imagePath = "modules/tsstatus/img/";
$tsstatus->showNicknameBox = false;
$tsstatus->showPasswordBox = false;
$tsstatus->decodeUTF8 = false;
$tsstatus->timeout = 2;
include "../classes/config_inc.php";
$date = date('h:i:s a');
$link3 = mysql_connect($db_host,$db_user,$db_pass) or die('Unable to establish a DB connection');
mysql_select_db($db_database,$link3);
$sql4 = "truncate `".$db_prefix."_ts3`";
mysql_query($sql4);
$sql3 = "insert into `".$db_prefix."_ts3` values(\"".addslashes("<div class='utilcontainer4'>".$tsstatus->render()."</div>")."\", \"$date\")";
mysql_query($sql3);
?>
