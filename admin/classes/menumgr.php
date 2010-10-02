<?php
function menuSave($id, $order, $name, $href, $type) {
	include "../classes/config_inc.php";
	mysql_connect($db_host,$db_user,$db_pass) or die(mysql_error());
	mysql_select_db($db_database) or die(mysql_error());
	mysql_query("update {$db_prefix}_mainmenu set `id`='{$id}', `order`='{$order}', `name`='{$name}', `href`='{$href}', `type`='{$type}' where `id`='{$id}'") or die("Error saving changes!".mysql_error()."");
	echo "<table class='container3'><tr><td>Changes Saved!</td></tr></table>";
}

function editmenu($id) {
	include "../classes/config_inc.php";
	mysql_connect($db_host,$db_user,$db_pass) or die(mysql_error());
	mysql_select_db($db_database) or die(mysql_error());
	$result = mysql_query("select * from {$db_prefix}_mainmenu where `id`='{$id}' limit 1;");
	if (mysql_num_rows($result) > 0) {
		$data=mysql_fetch_assoc($result);
		echo "<form action='' method='post'>";
		echo "<table class='container4'>";
		echo "<tr><td>Order:</td><td><input type='text' name='editMenuorder' value='{$data['order']}'></td></tr>";
		echo "<tr><td>Name:</td><td><input type='text' name='editMenuname' value='{$data['name']}'></td></tr>";
		echo "<tr><td>Link URL:</td><td><input type='text' name='editMenuhref' value='{$data['href']}'></td></tr>";
		echo "<tr><td>Type:</td><td>";
		switch($data['type']) {
			case "mainmenu":
				$main = "selected";
				break;
			case "adminmenu":
				$admin = "selected";
				break;
		}
		echo "<select name='editMenutype'><option value='mainmenu' {$main}>Main Menu</option><option value='adminmenu' {$admin}>Admin Menu</option></select>";
		echo "</td></tr>";
		echo "<input type='hidden' name='editMenuid' value='{$data['id']}'>";
		echo "<input type='hidden' name='action' value='menumgr'>";
		echo "<tr><td colspan='2'><button type='submit' class='nav' name='savemenu' value='menuSave'>Save</button></td></tr>";
		echo "</table>";
		echo "</form";
	} else {
		echo "Unable to edit menu item/invalid id";
	}
}

function deletemenu($id) {
	include "../classes/config_inc.php";
	mysql_connect($db_host,$db_user,$db_pass) or die(mysql_error());
	mysql_select_db($db_database) or die(mysql_error());
	mysql_query("delete from {$db_prefix}_mainmenu where id='{$id}'");
	echo "<table class='container3'><tr><td>Menu item Deleted!</td></tr></table>";
	echo menumgr();
}

function menumgr()
{
	include "../classes/config_inc.php";
	mysql_connect($db_host,$db_user,$db_pass) or die(mysql_error());
	mysql_select_db($db_database) or die(mysql_error());
	if ($_REQUEST['savemenu'] != '') {
		echo $_REQUEST['savemenu']($_REQUEST['editMenuid'], $_REQUEST['editMenuorder'], $_REQUEST['editMenuname'], $_REQUEST['editMenuhref'], $_REQUEST['editMenutype']);
	} else if ($_REQUEST['newmenu'] != '') {
		mysql_query("insert into `{$db_prefix}_mainmenu`(`order`,`name`,`href`,`type`) values('{$_REQUEST['newMenuorder']}','{$_REQUEST['newMenuname']}', '{$_REQUEST['newMenuhref']}', '{$_REQUEST['newMenutype']}')") or die("Error saving New Menu Item!: ".mysql_error()."");
	}
	echo "<form action='' method='post'>";
	echo "<table>";
	echo "<tr><td colspan='2'>New Menu Item:</td></tr>";
	echo "<tr><td>Order:</td><td><input type='text' name='newMenuorder' value='0'></td></tr>";
	echo "<tr><td>Name:</td><td><input type='text' name='newMenuname'></td></tr>";
	echo "<tr><td>Link URL:</td><td><input type='text' name='newMenuhref'></td></tr>";
	echo "<tr><td>Type:</td><td><select name='newMenutype'><option value='mainmenu'>Main Menu</option><option value='adminmenu'>Admin Menu</option></select></td></tr>";
	echo "<input type='hidden' name='action' value='menumgr'>";
	echo "<tr><td colspan='2'><button type='submit' class='nav' name='newmenu' value='newmenu'>Submit</button></td></tr>";
	echo "</table>";
	echo "</form><br><br>";
	$result = mysql_query("select * from {$db_prefix}_mainmenu ORDER BY `type` ASC");
	if (mysql_num_rows($result) > 0) {

		$fields_num = mysql_num_fields($result);

		echo "<h1>Menu Items:</h1>";
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
			$order = $data['order'];
			$name = $data['name'];
			$href = $data['href'];
			$type = $data['type'];

			echo "<tr>
			<td>{$order}</td><td>&nbsp;&nbsp;</td>
			<td>{$name}</td><td>&nbsp;&nbsp;</td>
			<td><font size='1'>{$href}</font></td><td>&nbsp;&nbsp;</td>
			<td><font size='1'>{$type}</font></td><td>&nbsp;&nbsp;</td>";
			echo "<td><form action='' method='post'>
			<button type='submit' class='nav' id='action' name='action' value='editmenu'>Edit</button><button type='submit' class='nav' id='action' name='action' value='deletemenu'>Delete</button>
			<input type='hidden' name='entID' value='{$id}'></form></td><td>&nbsp;&nbsp;</td></tr>";
		}
		mysql_free_result($result);
		echo "</table></td></tr></table>";
	} else {
		echo "No Entries in the Database {$db_database}<br>";
	}

}
?>