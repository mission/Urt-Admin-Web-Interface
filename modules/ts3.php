<?php
function ts3($host, $port, $vid) {
include('classes/config_inc.php');
$link3 = mysql_connect($db_host,$db_user,$db_pass) or die('Unable to establish a DB connection');
mysql_select_db($db_database,$link3);
$sql3 = "SELECT * FROM `".$db_prefix."_ts3` where (`ip`='".$host."' and `port`='".$port."') and `id`='".$vid."';";
$result3 = mysql_query($sql3);
if (!$result3) {
	echo "You need to add servers to the database!<br>";
}
while($row3 = mysql_fetch_assoc($result3)) {
	echo "<div align='center'>Last Updated: ".$row3['date']."</div><br>";
	echo stripcslashes($row3['data']);
}
}
?>