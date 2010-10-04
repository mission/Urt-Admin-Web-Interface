<?php
function recentbans() {
	include "classes/config_inc.php";
	echo "<div class='container9' align='center'><strong>Last 15 Active Bans</strong><br>";
	echo "<table class='utilcontainer4'><tr><td>Player</td><td>&nbsp;&nbsp;</td><td>IP</td><td>&nbsp;&nbsp;</td><td>Admin</td><td>&nbsp;&nbsp;</td><td width='50'>Reason</td><td>&nbsp;&nbsp;</td><td>Ban Length</td><td>&nbsp;&nbsp;</td><td>Ban Date</td><td>&nbsp;&nbsp;</td><td>Unban Date</td></tr><tr><td colspan='14' bgcolor='white' height='1'></td></tr>";
	$link = mysql_connect($db_host,$db_user,$db_pass) or die('Unable to establish a DB connection');
	mysql_select_db($db_database,$link);
	$sql = "SELECT * FROM `bans` WHERE `".$db_prefix."_status` = \"Active\" ORDER BY `bans`.`banid` DESC LIMIT 0, 15 ";
	$result = mysql_query($sql);
	if (!$result) {
		echo "Database has 0 bans or no bans are active<br>";
	}
	while($row = mysql_fetch_assoc($result))
	{
		$plname = $row['player'];
		$plip = $row['ip'];
		$pladmin = $row['admin'];
		$banreason = $row['reason'];
		$banlength = $row['length'];
		$bandate = $row['date'];
		$banun = $row['UnbanDate'];
		echo "<tr><td valign='top'>".strip_gtlt($plname)."</td><td>&nbsp;&nbsp;</td><td valign='top'>$plip</td><td>&nbsp;&nbsp;</td><td valign='top'>$pladmin</td><td>&nbsp;&nbsp;</td><td valign='top'>$banreason</td><td>&nbsp;&nbsp;</td><td valign='top'>$banlength</td><td>&nbsp;&nbsp;</td><td valign='top'>$bandate</td><td>&nbsp;&nbsp;</td><td valign='top'>$banun</td></tr>";
	}
	echo "</table></div>";
	echo "</div>";
	echo "<div id='flexcroll-init'></div>";
}
?>