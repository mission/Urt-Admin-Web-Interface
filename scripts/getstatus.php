<?php
define("INCLUDE_CHECK", true);
include "../classes/config_inc.php";
include "../classes/q3status.php";
$link1 = mysql_connect("$db_host", "$db_user", "$db_pass") or die(mysql_error());
mysql_select_db("$db_database", $link1) or die(mysql_error());
$sql11="SELECT * FROM `{$db_prefix}_servers` where `Status`='Online' order by `order` ASC";
$result11 = mysql_query($sql11) or die(mysql_error());
$date = date('h:i:s a');
while ($row1=mysql_fetch_assoc($result11)){
		$svdata = "";
		$svname = $row1['name'];
		$svip = $row1['ip'];
		$svport = $row1['port'];
		if ($svport == '27960') {
			$conninfo = "/connect {$svip}";
		} else {
			$conninfo = "/connect {$svip}:{$svport}";
		}
		$s = new q3status("$svip", "$svport"); // Create a new q3status with the server IP, Port.
		$s->update_status();
		$result = $s->playerlist;
		$svdata .=  "<div align='center'>";
		$svdata .=  "Server: {$s->cvarlist['sv_hostname']}<br>";
		$svdata .=  "Map: {$s->cvarlist['mapname']}<br>";
		$maxcl = $s->cvarlist['sv_maxclients'];
		$prcl = $s->cvarlist['sv_privateclients'];
		$max = ($maxcl-$prcl);
		$svdata .=  "#Players: {$s->get_num_players()}/{$max}<br><br>";
		$map = trim($s->cvarlist['mapname']);
		$scrn = getmapscrshot($map);
		$svdata .=  "<img src='$scrn' height='150' width='200'></img><br><br>";
		if ($s->get_num_players() < 1) {
			$svdata .=  "<table class='container7'><tr><td><div align='center' style='width:230px;height:150px;overflow:auto;' class='flexcroll'><table>";
			$svdata .=  "<tr><td>Server Empty..</td></tr>";
			$svdata .=  "<tr><td colspan='3' bgcolor='white' height='1'></td></tr>";
			$svdata .=  "</td></tr></table></div></td></tr></table><br>$conninfo</div>";
		} else {
			$svdata .=  "<table class='container7'><tr><td><div align='center' style='width:230px;height:150px;overflow:auto;' class='flexcroll'><table>";
			$svdata .=  "<tr><td>PlayerName:</td><td>&nbsp;&nbsp;</td><td>Score:</td></tr>";
			$svdata .=  "<tr><td colspan='3' bgcolor='white' height='1'></td></tr>";
			foreach($result as $arr) {
				$svdata .=  "<tr><td><font size='1'>".strip_gtlt($arr['strippedname'])."</font></td><td>&nbsp;&nbsp;</td><td><div align='right'>{$arr['score']}</div></td><tr>";
			}
			$svdata .=  "</td></tr></table></div></td></tr></table><br>{$conninfo}</div>";
		}
		insertdb($svip, $svport, $svdata, $date);
		
}


function getmapscrshot($mapname) {
		include "../classes/config_inc.php";
		$link = mysql_connect($db_host,$db_user,$db_pass) or die('Unable to establish a DB connection');
		mysql_select_db($db_database, $link);
		$sql = "Select * from `{$db_prefix}_maps` where `map`=\"{$mapname}\"";
		$result2 = mysql_query($sql);
		echo mysql_error()."<br>";
		if (!$result2) {
			$scrn = "images/mapshots/missing.jpg";
			mysql_close($link);
			return $scrn;
		} else {
			$row2 = mysql_fetch_assoc($result2);
			$scrn1[0] = $row2['screenshot1'];
			if($scrn1[0] != '') {
				$scrn1[1] = $row2['screenshot2'];
				$scrn1[2] = $row2['screenshot3'];
				$scrn1[3] = $row2['screenshot4'];
				$scrn = array_rand($scrn1, 1);
				$scrn = "images/mapshots/".$scrn1[$scrn];
			} else {
				$scrn = "images/mapshots/missing.jpg";
			}
			mysql_free_result($result2);
			mysql_close($link);
			return $scrn;
		}
}
function checkexists($ip, $port) {
		include "../classes/config_inc.php";
		$link = mysql_connect($db_host,$db_user,$db_pass) or die('Unable to establish a DB connection');
		mysql_select_db($db_database, $link);
		$result = mysql_query("select * from `{$db_prefix}_status` where `ip`='{$ip}' and `port`='{$port}' Limit 1");

		if (!$result) {
			mysql_close($link);
			return false;
		} else {
			if (mysql_num_rows($result) > 0) {
				mysql_close($link);
				return true;
			} else {
				mysql_close($link);
				return false;
			}
		}
}
function insertdb($ip, $port, $svdata, $date) {
		include "../classes/config_inc.php";
		if (checkexists($ip, $port) == true) {
			$sql = "update `{$db_prefix}_status` set `data`=\"{$svdata}\",`updated`=\"{$date}\" where `ip`=\"{$ip}\" and `port`=\"{$port}\"";
		} else {
			$sql = "insert into `{$db_prefix}_status` values('{$ip}', '{$port}', \"{$data}\", \"{$date}\")";
		}
		echo $sql."<br>";
		$link = mysql_connect($db_host,$db_user,$db_pass) or die('Unable to establish a DB connection');
		mysql_select_db($db_database, $link);
		mysql_query($sql);
		echo mysql_error();
		mysql_close($link);
}
?>