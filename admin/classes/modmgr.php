<?php
function modSave($id, $order, $file, $req1, $req2, $req3, $name, $pos, $class, $status) {
	include "../classes/config_inc.php";
	mysql_connect($db_host,$db_user,$db_pass) or die(mysql_error());
	mysql_select_db($db_database) or die(mysql_error());
	mysql_query("update {$db_prefix}_modules set `id`='{$id}', `order`='{$order}', `file`='{$file}', `requiredarg1`='{$req1}', `requiredarg2`='{$req2}', `requiredarg3`='{$req3}', `name`='{$name}', `pos`='{$pos}', `class`='{$class}', `status`='{$status}' where `id`='{$id}'") or die("Error saving changes!".mysql_error()."");
	echo "<table class='container3'><tr><td>Changes Saved!</td></tr></table>";
}

function editmod($id) {
	include "../classes/config_inc.php";
	mysql_connect($db_host,$db_user,$db_pass) or die(mysql_error());
	mysql_select_db($db_database) or die(mysql_error());
	$result = mysql_query("select * from {$db_prefix}_modules where `id`='{$id}' limit 1;");
	if (mysql_num_rows($result) > 0) {
		$data=mysql_fetch_assoc($result);
		echo "<form action='' method='post'>";
		echo "<table class='container4'>";
		echo "<tr><td>Order:</td><td><input type='text' name='editModorder' value='{$data['order']}'></td></tr>";
		echo "<tr><td>File:</td><td><input type='text' name='editModfile' value='{$data['file']}'></td></tr>";
		echo "<tr><td>RequiredArg1:</td><td><input type='text' name='editModreq1' value='{$data['requiredarg1']}'></td></tr>";
		echo "<tr><td>RequiredArg2:</td><td><input type='text' name='editModreq2' value='{$data['requiredarg2']}'></td></tr>";
		echo "<tr><td>RequiredArg3:</td><td><input type='text' name='editModreq3' value='{$data['requiredarg3']}'></td></tr>";
		echo "<tr><td>Name:</td><td><input type'text' name='editModname' value='{$data['name']}'></td></tr>";
		echo "<tr><td>Position:</td><td><select name='editModpos'>";
		$availpos = array("admin", "body", "footer", "left", "news", "reg", "user1", "user2", "user3");
		foreach ($availpos as $ps) {
			if ($ps == $data['pos']) {
				$selected = "selected";
			} else {
				$selected = "";
			}
			echo "<option value='{$ps}' {$selected}>{$ps}</option>";
		}
		echo "</select></td></tr>";
		echo "<tr><td>Class:</td><td><input type='text' name='editModclass' value='{$data['class']}'></td></tr>";
		switch($data['status']){
			case "Enabled":
				$enabled = "selected";
				break;
			case "Disabled":
				$disabled = "selected";
				break;
		}
		echo "<tr><td>Status:</td><td><select name='editModstatus'><option value='Enabled' {$enabled}>Enabled</option><option value='Disabled'{$disabled}>Disabled</option></select></td></tr>";
		echo "<input type='hidden' name='editModid' value='{$data['id']}'>";
		echo "<input type='hidden' name='action' value='modmgr'>";
		echo "<tr><td colspan='2'><button type='submit' class='nav' name='savemod' value='modSave'>Save</button></td></tr>";
		echo "</table>";
		echo "</form";
	} else {
		echo "Unable to edit module/invalid id";
	}
}

function deletemod($id) {
	include "../classes/config_inc.php";
	mysql_connect($db_host,$db_user,$db_pass) or die(mysql_error());
	mysql_select_db($db_database) or die(mysql_error());
	mysql_query("delete from {$db_prefix}_modules where id='{$id}'");
	echo "<table class='container3'><tr><td>Module Deleted!</td></tr></table>";
	echo modmgr();
}

function modmgr()
{
	include "../classes/config_inc.php";
	mysql_connect($db_host,$db_user,$db_pass) or die(mysql_error());
	mysql_select_db($db_database) or die(mysql_error());
	if ($_REQUEST['savemod'] != '') {
		echo $_REQUEST['savemod']($_REQUEST['editModid'], $_REQUEST['editModorder'], $_REQUEST['editModfile'], $_REQUEST['editModreq1'], $_REQUEST['editModreq2'], $_REQUEST['editModreq3'], $_REQUEST['editModname'], $_REQUEST['editModpos'], $_REQUEST['editModclass'], $_REQUEST['editModstatus']);
	} else if ($_REQUEST['newmod'] != '') {
		mysql_query("insert into `{$db_prefix}_modules`(`order`,`file`,`requiredarg1`,`requiredarg2`,`requiredarg3`,`name`,`pos`,`class`,`status`) values('{$_REQUEST['newModorder']}', '{$_REQUEST['newModfile']}', '{$_REQUEST['newModreq1']}', '{$_REQUEST['newModreq2']}', '{$_REQUEST['newModreq3']}', '{$_REQUEST['newModname']}', '{$_REQUEST['newModpos']}', '{$_REQUEST['newModclass']}', '{$_REQUEST['newModstatus']}')") or die("Error saving New Module!: ".mysql_error()."");
	}
	echo "<form action='' method='post'>";
	echo "<table>";
	echo "<tr><td colspan='2'>New Module:</td></tr>";
	echo "<tr><td>Order:</td><td><input type='text' name='newModorder' value='0'></td></tr>";
	echo "<tr><td>File:</td><td><input type='text' name='newModfile'></td></tr>";
	echo "<tr><td>RequiredArg1:</td><td><input type='text' name='newModreq1'></td></tr>";
	echo "<tr><td>RequiredArg2:</td><td><input type='text' name='newModreq2'></td></tr>";
	echo "<tr><td>RequiredArg3:</td><td><input type='text' name='newModreq3'></td></tr>";
	echo "<tr><td>Name:</td><td><input type'text' name='newModname'></td></tr>";
	echo "<tr><td>Position:</td><td><select name='newModpos'>";
	echo "<option value='admin'>admin</option>";
	echo "<option value='body'>body</option>";
	echo "<option value='footer'>footer</option>";
	echo "<option value='left' selected>left</option>";
	echo "<option value='news'>news</option>";
	echo "<option value='reg'>reg</option>";
	echo "<option value='user1'>user1</option>";
	echo "<option value='user2'>user2</option>";
	echo "<option value='user3'>user3</option>";
	echo "</select></td></tr>";
	echo "<tr><td>Class:</td><td><input type='text' name='newModclass'></td></tr>";
	echo "<tr><td>Status:</td><td><select name='newModstatus'><option value='Enabled' selected>Enabled</option><option value='Disabled'>Disabled</option></select></td></tr>";
	echo "<input type='hidden' name='action' value='modmgr'>";
	echo "<tr><td colspan='2'><button type='submit' class='nav' name='newmod' value='newmod'>Submit</button></td></tr>";
	echo "</table>";
	echo "</form><br><br>";
	$result = mysql_query("select * from {$db_prefix}_modules ORDER BY `pos` ASC");
	if (mysql_num_rows($result) > 0) {

		$fields_num = mysql_num_fields($result);

		echo "<h1>Modules:</h1>";
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
			$file = $data['file'];
			$req1 = $data['requiredarg1'];
			$req2 = $data['requiredarg2'];
			$req3 = $data['requiredarg3'];
			$name = $data['name'];
			$pos = $data['pos'];
			$class = $data['class'];
			switch($data['status']){
				case "Enabled":
					$status = "<font color='lime'>{$data['status']}</font>";
					break;
				case "Disabled":
					$status = "<font color='red'>{$data['status']}</font>";
					break;
			}
			if (!isset($status)) {
				$status = $data['status'];
			}
			echo "<tr>
			<td>{$order}</td><td>&nbsp;&nbsp;</td>
			<td><font size='1'>{$file}</font></td><td>&nbsp;&nbsp;</td>
			<td><font size='1'>{$req1}</font></td><td>&nbsp;&nbsp;</td>
			<td><font size='1'>{$req2}</font></td><td>&nbsp;&nbsp;</td>
			<td><font size='1'>{$req3}</font></td><td>&nbsp;&nbsp;</td>
			<td><font size='1'>{$name}</font></td><td>&nbsp;&nbsp;</td>
			<td>{$pos}</td><td>&nbsp;&nbsp;</td>
			<td>{$class}</td><td>&nbsp;&nbsp;</td>
			<td>{$status}</td><td>&nbsp;&nbsp;</td>";
			echo "<td><form action='' method='post'>
			<button type='submit' id='action' class='nav' name='action' value='editmod'>Edit</button><button type='submit' class='nav' id='action' name='action' value='deletemod'>Delete</button>
			<input type='hidden' name='entID' value='{$id}'></form></td><td>&nbsp;&nbsp;</td></tr>";
		}
		mysql_free_result($result);
		echo "</table></td></tr></table>";
	} else {
		echo "No Entries in the Database {$db_database}<br>";
	}

}
?>