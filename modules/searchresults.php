<?php
function searchresults()
{
		$stype = $_REQUEST['stype'];
		$sparm = $_REQUEST['sparm'];
		include("../classes/config_inc.php");
		if ($sparm != "") {
		echo "<div align='center'><table><td><tr><table class='utilcontainer3'><tr><td colspan='11'><div align='center'><strong>Player Search</strong></div></td></tr>";
		echo "<tr><td><strong>Name</strong></td><td>&nbsp;&nbsp;</td><td><strong>IP</strong></td><td>&nbsp;&nbsp;</td><td><strong>GUID</strong></td><td>&nbsp;&nbsp;</td><td><strong>Last Server</strong></td><td>&nbsp;&nbsp;</td><td><strong>Seen Last</strong></td><td>&nbsp;&nbsp;</td><td><strong>Added on</strong></td></tr>";
		echo "<tr><td colspan='11' bgcolor='black' height='1'></td></tr>";
		$matchall = $_REQUEST['match'];
		if ($matchall == "") {
		mysql_connect("$db_host", "$db_user", "$db_pass") or die(mysql_error());
		mysql_select_db("$db_database") or die(mysql_error());
		$sql = "Select * From ".$db_prefix."_players Where `$stype` LIKE '%$sparm%'";
		$result = mysql_query($sql);
		while ($data=mysql_fetch_assoc($result)){
		$pname = $data['name'];
		$pip = $data['ip'];
		$pguid = $data['guid'];
		$plast = $data['last'];
		$padded = $data['added'];
		$pon = $data['laston'];
		echo "<tr><td>".strip_gtlt($pname)."</td><td>&nbsp;&nbsp;</td><td>$pip</td><td>&nbsp;&nbsp;</td><td><font size='1'>$pguid</font></td><td>&nbsp;&nbsp;</td><td><font size='1'>$pon</font></td><td>&nbsp;&nbsp;</td><td>$plast</td><td>&nbsp;&nbsp;</td><td>$padded</td></tr>";
		echo "<tr><td colspan='11' bgcolor='black' height='1'></td></tr>";
		}
		echo "</table></div>";
		} else {
		mysql_connect("$db_host", "$db_user", "$db_pass") or die(mysql_error());
		mysql_select_db("$db_database") or die(mysql_error());
		$sql = "Select * From ".$db_prefix."_players Where `$stype`='$sparm'";
		$result = mysql_query($sql);
		while ($data=mysql_fetch_assoc($result)){
		$pname = $data['name'];
		$pip = $data['ip'];
		$pguid = $data['guid'];
		$plast = $data['last'];
		$padded = $data['added'];
		$pon = $data['laston'];
		echo "<tr><td>".strip_gtlt($pname)."</td><td>&nbsp;&nbsp;</td><td>$pip</td><td>&nbsp;&nbsp;</td><td>$pguid</td><td>&nbsp;&nbsp;</td><td>$pon</td><td>&nbsp;&nbsp;</td><td>$plast</td><td>&nbsp;&nbsp;</td><td>$padded</td></tr>";
		echo "<tr><td colspan='11' bgcolor='black' height='1'></td></tr>";
		}
		echo "</table></div>";
		}
		}
}
?>