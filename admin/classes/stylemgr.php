<?php
function styleSave($id, $name, $folder) {
	include "../classes/config_inc.php";
	mysql_connect($db_host,$db_user,$db_pass) or die(mysql_error());
	mysql_select_db($db_database) or die(mysql_error());
	mysql_query("update {$db_prefix}_styles set `id`='{$id}', `name`='{$name}', `folder`='{$folder}' where `id`='{$id}'") or die("Error saving changes!".mysql_error()."");
	echo "<table class='container3'><tr><td>Changes Saved!</td></tr></table>";
}

function editstyle($id) {
	include "../classes/config_inc.php";
	mysql_connect($db_host,$db_user,$db_pass) or die(mysql_error());
	mysql_select_db($db_database) or die(mysql_error());
	$result = mysql_query("select * from {$db_prefix}_styles where `id`='{$id}' limit 1;");
	if (mysql_num_rows($result) > 0) {
		$data=mysql_fetch_assoc($result);
		echo "<form action='' method='post'>";
		echo "<table class='container4'>";
		echo "<tr><td>Name:</td><td><input type='text' name='editStylename' value='{$data['name']}'></td></tr>";
		echo "<tr><td>Folder:</td><td><input type='text' name='editStylefolder' value='{$data['folder']}'></td></tr>";
		echo "<input type='hidden' name='editStyleid' value='{$data['id']}'>";
		echo "<input type='hidden' name='action' value='stylemgr'>";
		echo "<tr><td colspan='2'><button type='submit' class='nav' name='savestyle' value='styleSave'>Save</button></td></tr>";
		echo "</table>";
		echo "</form";
	} else {
		echo "Unable to edit style/invalid id";
	}
}

function deletestyle($id) {
	include "../classes/config_inc.php";
	mysql_connect($db_host,$db_user,$db_pass) or die(mysql_error());
	mysql_select_db($db_database) or die(mysql_error());
	mysql_query("delete from {$db_prefix}_styles where id='{$id}'");
	echo "<table class='container3'><tr><td>Style Deleted!</td></tr></table>";
	echo stylemgr();
}

function stylemgr()
{
	include "../classes/config_inc.php";
	mysql_connect($db_host,$db_user,$db_pass) or die(mysql_error());
	mysql_select_db($db_database) or die(mysql_error());
	if ($_REQUEST['savestyle'] != '') {
		echo $_REQUEST['savestyle']($_REQUEST['editStyleid'], $_REQUEST['editStylename'], $_REQUEST['editStylefolder']);
	} else if ($_REQUEST['newstyle'] != '') {
		mysql_query("insert into `{$db_prefix}_styles`(`name`,`folder`) values('{$_REQUEST['newStylename']}', '{$_REQUEST['newStylefolder']}')") or die("Error saving New Style!: ".mysql_error()."");
	}
	echo "<form action='' method='post'>";
	echo "<table>";
	echo "<tr><td colspan='2'>New Style:</td></tr>";
	echo "<tr><td>Name:</td><td><input type='text' name='newStylename'></td></tr>";
	echo "<tr><td>Folder:</td><td><input type='text' name='newStylefolder'></td></tr>";
	echo "<input type='hidden' name='action' value='stylemgr'>";
	echo "<tr><td colspan='2'><button type='submit' class='nav' name='newstyle' value='newstyle'>Submit</button></td></tr>";
	echo "</table>";
	echo "</form><br><br>";
	$result = mysql_query("select * from {$db_prefix}_styles");
	if (mysql_num_rows($result) > 0) {

		$fields_num = mysql_num_fields($result);

		echo "<h1>Styles:</h1>";
		echo "<table class='container4'><tr><td><table><tr>";
		// printing table headers
		for($i=0; $i<$fields_num; $i++)
		{
			$field = mysql_fetch_field($result);
			if (($field->name) == "id")
				continue;
			echo "<td>{$field->name}</td><td>&nbsp;&nbsp;</td>";
		}
		echo "<td>Option</td><td>&nbsp;&nbsp;</td>";
		echo "</tr>";
		while ($data=mysql_fetch_assoc($result))
		{
			$id = $data['id'];
			$name = $data['name'];
			$folder = $data['folder'];

			echo "<tr>
			<td>{$name}</td><td>&nbsp;&nbsp;</td>
			<td><font size='1'>{$folder}</font></td><td>&nbsp;&nbsp;</td>";
			echo "<td><form action='' method='post'>
			<button type='submit' class='nav' id='action' name='action' value='editstyle'>Edit</button><button type='submit' class='nav' id='action' name='action' value='deletestyle'>Delete</button>
			<input type='hidden' name='entID' value='{$id}'></form></td><td>&nbsp;&nbsp;</td></tr>";
		}
		mysql_free_result($result);
		echo "</table></td></tr></table>";
	} else {
		echo "No Entries in the Database {$db_database}<br>";
	}

}
?>