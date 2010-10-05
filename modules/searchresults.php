<?php
function searchresults()
{
		$stype = $_REQUEST['stype'];
		$sparm = $_REQUEST['sparm'];
		include("../classes/config_inc.php");
		if ($sparm != "") {
		echo "<div align='center'><table><td><tr><table class='container9'><tr><td colspan='11'><div align='center'><strong>Player Search</strong></div></td></tr>";
		echo "<tr><td><strong>Name</strong></td><td>&nbsp;&nbsp;</td><td><strong>IP</strong></td><td>&nbsp;&nbsp;</td><td><strong>GUID</strong></td><td>&nbsp;&nbsp;</td><td><strong>Last Server</strong></td><td>&nbsp;&nbsp;</td><td><strong>Seen Last</strong></td><td>&nbsp;&nbsp;</td><td><strong>Added on</strong></td></tr>";
		echo "<tr><td colspan='11' bgcolor='black' height='1'></td></tr>";
		$matchall = $_REQUEST['match'];
		if ($matchall == "") {
			$sql = "Select * from `{$db_prefix}_players` where `{$stype}` LIKE '%$sparm%'";
		} else {
			$sql = "Select * from `{$db_prefix}_players` where `{$stype}`='$sparm'";
		}
		mysql_connect("$db_host", "$db_user", "$db_pass") or die(mysql_error());
		mysql_select_db("$db_database") or die(mysql_error());
		$result = mysql_query($sql);
		$ips = array();
		$guids = array();
		$names = array();
		while ($data=mysql_fetch_assoc($result)){
			$pname = $data['name'];
			$pip = $data['ip'];
			$pguid = $data['guid'];
			$plast = $data['last'];
			$padded = $data['added'];
			$pon = $data['laston'];
			if(!in_array($pip, $ips)) {
				$ips[] = $pip;
			}
			if(!in_array($pguid, $guids)) {
				$guids[] = $pguid;
			}
			if(!in_array($pname, $names)) {
				$names[] = $pname;
			}
			echo "<tr><td>".strip_gtlt($pname)."</td><td>&nbsp;&nbsp;</td><td>$pip</td><td>&nbsp;&nbsp;</td><td><font size='1'>$pguid</font></td><td>&nbsp;&nbsp;</td><td><font size='1'>$pon</font></td><td>&nbsp;&nbsp;</td><td>$plast</td><td>&nbsp;&nbsp;</td><td>$padded</td></tr>";
			echo "<tr><td colspan='11' bgcolor='black' height='1'></td></tr>";
		}
		echo "</table></td></tr></table>";
		if($stype != "guid") {
			echo "<table class='container9'><tr><td colspan='11'><div align='center'><strong>Player Search Cross Reference[GUID]:</strong></div></td></tr>";
			echo "<tr><td><strong>Name</strong></td><td>&nbsp;&nbsp;</td><td><strong>IP</strong></td><td>&nbsp;&nbsp;</td><td><strong>GUID</strong></td><td>&nbsp;&nbsp;</td><td><strong>Last Server</strong></td><td>&nbsp;&nbsp;</td><td><strong>Seen Last</strong></td><td>&nbsp;&nbsp;</td><td><strong>Added on</strong></td></tr>";
			echo "<tr><td colspan='11' bgcolor='black' height='1'></td></tr>";

			foreach($guids as $guid) {
				mysql_connect("$db_host", "$db_user", "$db_pass") or die(mysql_error());
				mysql_select_db("$db_database") or die(mysql_error());
				$sql = "Select * from `{$db_prefix}_players` where `guid`='{$guid}'";
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
			}
			echo "</table>";
		}
		if ($stype != "ip") {
			echo "<table class='container9'><tr><td colspan='11'><div align='center'><strong>Player Search Cross Reference[IP]:</strong></div></td></tr>";
			echo "<tr><td><strong>Name</strong></td><td>&nbsp;&nbsp;</td><td><strong>IP</strong></td><td>&nbsp;&nbsp;</td><td><strong>GUID</strong></td><td>&nbsp;&nbsp;</td><td><strong>Last Server</strong></td><td>&nbsp;&nbsp;</td><td><strong>Seen Last</strong></td><td>&nbsp;&nbsp;</td><td><strong>Added on</strong></td></tr>";
			echo "<tr><td colspan='11' bgcolor='black' height='1'></td></tr>";
			
			foreach($ips as $ip) {
				mysql_connect("$db_host", "$db_user", "$db_pass") or die(mysql_error());
				mysql_select_db("$db_database") or die(mysql_error());
				$sql = "Select * from `{$db_prefix}_players` where `ip`='{$ip}'";
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
			}
			echo "</table>";
		}
		if ($stype != "name") {
			echo "<table class='container9'><tr><td colspan='11'><div align='center'><strong>Player Search Cross Reference[Name]:</strong></div></td></tr>";
			echo "<tr><td><strong>Name</strong></td><td>&nbsp;&nbsp;</td><td><strong>IP</strong></td><td>&nbsp;&nbsp;</td><td><strong>GUID</strong></td><td>&nbsp;&nbsp;</td><td><strong>Last Server</strong></td><td>&nbsp;&nbsp;</td><td><strong>Seen Last</strong></td><td>&nbsp;&nbsp;</td><td><strong>Added on</strong></td></tr>";
			echo "<tr><td colspan='11' bgcolor='black' height='1'></td></tr>";
			
			foreach($names as $name) {
				mysql_connect("$db_host", "$db_user", "$db_pass") or die(mysql_error());
				mysql_select_db("$db_database") or die(mysql_error());
				$sql = "Select * from `{$db_prefix}_players` where `name`='{$name}'";
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
			}
			echo "</table>";
		}
		echo "</div>";
		}
}
?>