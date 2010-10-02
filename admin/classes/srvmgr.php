<?php
function srvSave($id, $order, $name, $ip, $port, $version, $rconpass, $status) {
	include "../classes/config_inc.php";
	mysql_connect($db_host,$db_user,$db_pass) or die(mysql_error());
	mysql_select_db($db_database) or die(mysql_error());
	mysql_query("update {$db_prefix}_servers set `id`='{$id}', `order`='{$order}', `name`='{$name}', `ip`='{$ip}', `port`='{$port}', `version`='{$version}', `rconpass`='{$rconpass}', `Status`='{$status}' where `id`='{$id}'") or die("Error saving changes!".mysql_error()."");
	echo "<table class='container3'><tr><td>Changes Saved!</td></tr></table>";
}

function editsrv($id) {
	include "../classes/config_inc.php";
	mysql_connect($db_host,$db_user,$db_pass) or die(mysql_error());
	mysql_select_db($db_database) or die(mysql_error());
	$result = mysql_query("select * from {$db_prefix}_servers where `id`='{$id}' limit 1;");
	if (mysql_num_rows($result) > 0) {
		$data=mysql_fetch_assoc($result);
		echo "<form action='' method='post'>";
		echo "<table class='container4'>";
		echo "<tr><td>Order:</td><td><input type='text' name='editSrvorder' value='{$data['order']}'></td></tr>";
		echo "<tr><td>Name:</td><td><input type='text' name='editSrvname' value='{$data['name']}'></td></tr>";
		echo "<tr><td>IP:</td><td><input type='text' name='editSrvip' value='{$data['ip']}'></td></tr>";
		echo "<tr><td>Port:</td><td><input type='text' name='editSrvport' value='{$data['port']}'></td></tr>";
		echo "<tr><td>Version[ioq3 1.35/ioq3 1.36]:</td><td><input type='text' name='editSrvversion' value='{$data['version']}'></td></tr>";
		echo "<tr><td>Rcon Password:</td><td><input type'text' name='editSrvrconpass' value='{$data['rconpass']}'></td></tr>";
		switch ($data['Status']) {
			case "Online":
				$online = "selected";
				break;
			case "Offline":
				$offline = "selected";
				break;
		}
		echo "<tr><td>Status:</td><td><select name='editSrvstatus'><option value='Online'{$online}>Online</option><option value='Offline'{$offline}>Offline</option></select></td></tr>";
		echo "<input type='hidden' name='editSrvid' value='{$data['id']}'>";
		echo "<input type='hidden' name='action' value='srvmgr'>";
		echo "<tr><td colspan='2'><button type='submit' class='nav' name='savesrv' value='srvSave'>Save</button></td></tr>";
		echo "</table>";
		echo "</form";
	} else {
		echo "Unable to edit server/invalid id";
	}
}

function deletesrv($id) {
	include "../classes/config_inc.php";
	mysql_connect($db_host,$db_user,$db_pass) or die(mysql_error());
	mysql_select_db($db_database) or die(mysql_error());
	mysql_query("delete from {$db_prefix}_servers where id='{$id}'");
	echo "<table class='container3'><tr><td>Server Deleted!</td></tr></table>";
	echo srvmgr();
}

function srvmgr()
{
	include "../classes/config_inc.php";
	mysql_connect($db_host,$db_user,$db_pass) or die(mysql_error());
	mysql_select_db($db_database) or die(mysql_error());
	if ($_REQUEST['savesrv'] != '') {
		echo $_REQUEST['savesrv']($_REQUEST['editSrvid'], $_REQUEST['editSrvorder'], $_REQUEST['editSrvname'], $_REQUEST['editSrvip'], $_REQUEST['editSrvport'], $_REQUEST['editSrvversion'], $_REQUEST['editSrvrconpass'], $_REQUEST['editSrvstatus']);
	} else if ($_REQUEST['newsrv'] != '') {
		mysql_query("insert into `{$db_prefix}_servers`(`order`,`name`,`ip`,`port`,`version`,`rconpass`,`Status`) values('{$_REQUEST['newSrvorder']}', '{$_REQUEST['newSrvname']}', '{$_REQUEST['newSrvip']}', '{$_REQUEST['newSrvport']}', '{$_REQUEST['newSrvversion']}', '{$_REQUEST['newSrvrconpass']}', '{$_REQUEST['newSrvstatus']}')") or die("Error saving New Server!: ".mysql_error()."");
	}
	echo "<form action='' method='post'>";
	echo "<table>";
	echo "<tr><td colspan='2'>New Server:</td></tr>";
	echo "<tr><td>Order:</td><td><input type='text' name='newSrvorder' value='0'></td></tr>";
	echo "<tr><td>Name:</td><td><input type='text' name='newSrvname'></td></tr>";
	echo "<tr><td>IP:</td><td><input type='text' name='newSrvip'></td></tr>";
	echo "<tr><td>Port:</td><td><input type='text' name='newSrvport'></td></tr>";
	echo "<tr><td>Version[ioq3 1.35/ioq3 1.36]:</td><td><input type='text' name='newSrvversion' value='ioq3 1.35'></td></tr>";
	echo "<tr><td>Rcon Password:</td><td><input type'text' name='newSrvrconpass'></td></tr>";
	echo "<tr><td>Status:</td><td><select name='newSrvstatus'><option value='Online' selected>Online</option><option value='Offline'>Offline</option></select></td></tr>";
	echo "<input type='hidden' name='action' value='srvmgr'>";
	echo "<tr><td colspan='2'><button type='submit' class='nav' name='newsrv' value='newsrv'>Submit</button></td></tr>";
	echo "</table>";
	echo "</form><br><br>";
	$result = mysql_query("select * from {$db_prefix}_servers");
	if (mysql_num_rows($result) > 0) {

		$fields_num = mysql_num_fields($result);

		echo "<h1>Servers:</h1>";
		echo "<table class='container4'><tr><td><table><tr>";
		// printing table headers
		for($i=0; $i<$fields_num; $i++)
		{
			$field = mysql_fetch_field($result);
			echo "<td>{$field->name}</td><td>&nbsp;&nbsp;</td>";
		}
		echo "<td>Option</td><td>&nbsp;&nbsp;</td>";
		echo "</tr>";
		while ($data=mysql_fetch_assoc($result))
		{
			$id = $data['id'];
			$order = $data['order'];
			$name = $data['name'];
			$ip = $data['ip'];
			$port = $data['port'];
			$version = $data['version'];
			$rconpass = $data['rconpass'];
			switch($data['Status']) {
				case "Online":
					$status = "<font color='lime'>{$data['Status']}</font>";
					break;
				case "Offline":
					$status = "<font color='red'>{$data['Status']}</font>";
					break;
			}
			if (!isset($status)) {
				$status = $data['Status'];
			}
			echo "<tr><td>{$id}</td><td>&nbsp;&nbsp;</td>
			<td>{$order}</td><td>&nbsp;&nbsp;</td>
			<td>{$name}</td><td>&nbsp;&nbsp;</td>
			<td>{$ip}</td><td>&nbsp;&nbsp;</td>
			<td>{$port}</td><td>&nbsp;&nbsp;</td>
			<td>{$version}</td><td>&nbsp;&nbsp;</td>
			<td>{$rconpass}</td><td>&nbsp;&nbsp;</td>
			<td>{$status}</td><td>&nbsp;&nbsp;</td>";
			echo "<td><form action='' method='post'>
			<button type='submit' id='action' class='nav' name='action' value='editsrv'>Edit</button><button type='submit' class='nav' id='action' name='action' value='deletesrv'>Delete</button>
			<input type='hidden' name='entID' value='{$id}'></form></td><td>&nbsp;&nbsp;</td></tr>";
		}
		mysql_free_result($result);
		echo "</table></td></tr></table>";
	} else {
		echo "No Entries in the Database {$db_database}<br>";
	}

}
?>