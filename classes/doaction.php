<?php

class doaction {
	public function ban($ip, $bname, $breason, $blength, $badmin) {
		define("INCLUDE_CHECK", true);
		include("config_inc.php");
		$link = mysql_connect($db_host,$db_user,$db_pass) or die('Unable to establish a DB connection');
		mysql_select_db($db_database,$link);
		$sql = "SELECT * FROM `".$db_prefix."_servers` WHERE `Status`='Online'";
		$result = mysql_query($sql);
		if (!$result) {
			echo "You have 0 servers or none of the servers are online<br>";
		}
		$out = array();
		$out[0] = "<div class='utilcontainer4'><div align='center'><h1><strong>Ban Results</strong></h1></div><br>Banning $bname($blength) - $ip - <font color='red'>Reason:</font> $breason<br><br>";
		$i = 1;
		while($row = mysql_fetch_assoc($result))
		{
			$sname = $row['name'];
			$sip = $row['ip'];
			$sport = $row['port'];
			$srcon = $row['rconpass'];
			$sver = $row['version'];
			$r = new q3rcon("$sip", "$sport", "$srcon");
			if ($sver == "ioq3 1.36") {
				$r->send_command("banaddr $ip/24");
				$response = $r->get_response();
				$out[$i] = "Banning $ip on $sname - $sip:$sport	::".$response."<br>";
			} else {
				$r->send_command("addip $ip/24");
				$response = $r->get_response();
				$out[$i] = "Banning $ip on $sname - $sip:$sport	::".$response."<br>";
			}
			$i++;
		}
		$bdate = date('h:i:s a m-d-Y');
		$sql2 = "Insert into `".$db_prefix."_bans`(player, ip, admin, reason, length, date, Status, UnbanDate) values(\"$bname\", \"$ip\", \"$badmin\", \"$breason\", \"$blength\", \"$bdate\", \"Active\", \"N/A\")";
		mysql_query($sql2);
		$out[$i] = "</div>";
		return $out;
	}
	public function kick($slot, $svid) {
		define("INCLUDE_CHECK", true);
		include("config_inc.php");
		$link = mysql_connect($db_host,$db_user,$db_pass) or die('Unable to establish a DB connection');
		mysql_select_db($db_database,$link);
		$sql = "SELECT * FROM ".$db_prefix."_servers WHERE id = '".$svid."'";
		$result = mysql_query($sql);
		if (!$result) {
			echo "You have 0 servers or none of the servers are online<br>";
		}
		$row = mysql_fetch_assoc($result);
		$sname = $row['name'];
		$sip = $row['ip'];
		$sport = $row['port'];
		$srcon = $row['rconpass'];
		
		$r = new q3rcon("$sip", "$sport", "$srcon");
		$command = "kick $slot";
		$r->send_command($command);
		$out = $r->get_response();
		echo "<div class='utilcontainer5'>";
		echo $out;
		echo "</div>";
	}
	
	public function slap1($plslot, $svid) {
		define("INCLUDE_CHECK", true);
		include("config_inc.php");
		$link = mysql_connect($db_host,$db_user,$db_pass) or die('Unable to establish a DB connection');
		mysql_select_db($db_database,$link);
		$sql = "SELECT * FROM ".$db_prefix."_servers WHERE id = '".$svid."'";
		$result = mysql_query($sql);
		if (!$result) {
			echo "You have 0 servers or none of the servers are online<br>";
		}
		$row = mysql_fetch_assoc($result);
		$sname = $row['name'];
		$sip = $row['ip'];
		$sport = $row['port'];
		$srcon = $row['rconpass'];
		$sver = $row['version'];
		$r = new q3rcon("$sip", "$sport", "$srcon");
		$command = ("slap $plslot");
		$r->send_command($command);
		$out = $r->get_response();
		echo "<div class='utilcontainer5'>";
		if ($out == "") {
			echo "$plslot was Successfully Slapped!";
		} else {
			echo "$out";
		}
		echo "</div>";
	}
}
			
		

class banip {
	public function ban($serverip, $serverport, $serverrcon, $serverver, $ip) {
		
		$r = new q3rcon("$serverip", "$serverport", "$serverrcon");
		if ($serverver == "ioq3 1.36") {
			$r->send_command("banaddr $ip/24");
			$response = $r->get_response();
			return "$response</td></tr>";
		} else {
			$r->send_command("addip $ip/24");
			$response = $r->get_response();
			return "$response</td></tr>";
		}
	}
}
		