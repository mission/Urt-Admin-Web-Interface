<?php
define("INCLUDE_CHECK", true);
include_once('../classes/q3rcon.php');
include_once('../classes/q3status.php');
include "../classes/config_inc.php";
mysql_connect("$db_host", "$db_user", "$db_pass") or die(mysql_error());
mysql_select_db("$db_database") or die(mysql_error());
$sql="SELECT * FROM {$db_prefix}_servers where Status='Online'";
$result =mysql_query($sql);
while ($data=mysql_fetch_assoc($result)) {
	$svname = $data['name'];
	$svname = stripslashes($svname);
	$svip = $data['ip'];
	$svport = $data['port'];
	$svrcon = $data['rconpass'];
	$r = new q3rcon("$svip", "$svport", "$svrcon");
	$players = $r->get_players();
	if ($players =="") {
		echo "Player info not available";
	} else {
		foreach ($players as $player) {
			$pid = "NULL";
			$slotnum = $player['num'];
			$score = $player['score'];
			$ping = $player['ping'];
			$name = $player['stripped_name'];
			$oname = $player['stripped_name'];
			$guid = $r->dump_guid("$slotnum");
			sleep(1);
	  
			if ($name =="") {
			echo "no name is available, continuing without database entry";
			} elseif ($guid =="") {
			echo "no guid is available, continuing without database entry";
			} else {
				addslashes($name);
				list($ip) = explode(":", $player['address'], 2);
				mysql_connect("$db_host", "$db_user", "$db_pass") or die(mysql_error());
				mysql_select_db("$db_database") or die(mysql_error());
				$runq = "SELECT * FROM `{$db_prefix}_players` WHERE `name` LIKE CONVERT(_utf8 \"{$name}\" USING latin1) COLLATE latin1_swedish_ci AND `ip` LIKE CONVERT(_utf8 \"{$ip}\" USING latin1) COLLATE latin1_swedish_ci AND `guid`='{$guid}'";
				$runqresult = mysql_query($runq);
				$count=mysql_num_rows($runqresult);
				$data=mysql_fetch_assoc($runqresult);
				$plid = $data['id'];
				if($count == '1') {
					  // update date entry for player
					$location = "n/a";
					$date= date('h:i:s a m-d-Y');
					$name = addslashes($name);
					echo "$name on $svname with $ip already in the database @ entry# $plid! Updating entry @ $date<br>";
					mysql_connect("$db_host", "$db_user", "$db_pass") or die(mysql_error());
					mysql_select_db("$db_database") or die(mysql_error());
					$runq2 = "UPDATE {$db_prefix}_players SET last = \"{$date}\", laston = \"{$svname}\"
					WHERE id = '{$plid}' LIMIT 1";
					mysql_query($runq2);
				} else {
					//insert new data entry for player
					$location = "n/a";
					$date= date('h:i:s a m-d-Y');
					$name = addslashes($name);
					mysql_connect("$db_host", "$db_user", "$db_pass") or die(mysql_error());
					mysql_select_db("$db_database") or die(mysql_error());
					mysql_query("INSERT INTO `{$db_prefix}_players` VALUES ('NULL', \"{$name}\", '{$ip}', '{$guid}', '{$date}', '{$date}', '{$svname}')");
					echo "{$name} on {$svname} with {$ip} and {$guid} inserted into database at {$date}<br>";
				}
			}
		}
	}
			
}

?>