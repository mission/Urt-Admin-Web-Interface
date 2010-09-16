<?php
function serverview($serverip, $serverport)
{		
		include "classes/config_inc.php";
		$link99 = mysql_connect($db_host,$db_user,$db_pass) or die('Unable to establish a DB connection');
		mysql_select_db($db_database, $link99);
		$sql = "Select * from `".$db_prefix."_status` where `ip`=\"$serverip\" and `port`=\"$serverport\" LIMIT 1";
		$result2 = mysql_query($sql);
		if (!$result2) {
			echo "<div align='center'>".mysql_error()."</div>";
		} else {
			if (mysql_num_rows($result2) > 0) {
				$row = mysql_fetch_assoc($result2);
				$out = $row['data'];
				$update = $row['updated'];
				echo "<div align='center'>Last Updated: $update</div><br>";
				echo $out;
			} else {
				echo "<div align='center'> No Player Status in Database for: ".$serverip.":".$serverport."</div>";
			}
		}
}
?>