<?php
function default_body()
{
	echo "<table>";
	echo "<tr><td><strong>Server Name</strong></td><td>&nbsp;&nbsp;</td><td><strong>IP</strong></td><td>&nbsp;&nbsp;</td><td><strong>Port</strong></td><td>&nbsp;&nbsp;</td><td><strong>Connect Info</strong></td></tr>";
	include "classes/config_inc.php";
	mysql_connect("$db_host", "$db_user", "$db_pass") or die(mysql_error());
  	mysql_select_db("$db_database") or die(mysql_error());
	$sql="SELECT * FROM ".$db_prefix."_servers where `status`='Online' order by `order` ASC";
	$result =mysql_query($sql);
	while ($data=mysql_fetch_assoc($result)){
		$svname = $data['name'];
		$svip = $data['ip'];
		$svport = $data['port'];
		echo "<tr><td>$svname</td><td>&nbsp;&nbsp;</td><td>$svip</td><td>&nbsp;&nbsp;</td><td>$svport</td><td>&nbsp;&nbsp;</td><td>/connect $svip:$svport</td></tr>";
	} 
	echo "</table>";
}
?>