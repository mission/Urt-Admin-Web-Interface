<?php
function serverview($serverip, $serverport)
{		
		include "classes/config_inc.php";
		$link99 = mysql_connect($db_host,$db_user,$db_pass) or die('Unable to establish a DB connection');
		mysql_select_db($db_database, $link99);
		$map = trim($s->cvarlist['mapname']);
		$sql = "Select * from `serverinfo` where `ip`=\"$serverip\" and `port`=\"$serverport\" LIMIT 1";
		$result2 = mysql_query($sql);
		$row = mysql_fetch_assoc($result2);
		
		$out = $row['data'];
		$update = $row['updated'];
		echo "<div align='center'>Last Updated: $update</div><br>";
		echo $out;
}
?>