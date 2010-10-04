<?php

function settingsmgr() {
	include("../classes/config_inc.php");
	if (isset($_REQUEST['saveSet'])) {
		mysql_connect("$db_host", "$db_user", "$db_pass") or die(mysql_error());
		mysql_select_db("$db_database") or die(mysql_error());
		$i = 1;
		while ($i <= $_REQUEST['numEnt']) {
			$value = $_REQUEST['var'.$i];
			$id = $_REQUEST['var'.$i.'_id'];
			mysql_query("update `{$db_prefix}_settings` set `value`='{$value}' where `id`='{$id}'");
			$i++;
		}
		echo "<table class='container4'><tr><td>Settings Saved!</td></tr></table><br><br>";
	}

	mysql_connect("$db_host", "$db_user", "$db_pass") or die(mysql_error());
	mysql_select_db("$db_database") or die(mysql_error());
	$sql = "Select * From ".$db_prefix."_settings";
	$result = mysql_query($sql) or die(mysql_error());
	$i = 0;
	echo "<h1>Settings:</h1>";
	echo "<table class='container4'><form action='' method='post'>";
	if ($result) {
	$numrows = mysql_num_rows($result);
	if ($numrows > 0) {
		while ($data=mysql_fetch_assoc($result)){
			$i++;
			echo "<tr><td>{$data['var']}</td><td><input type='text' name='var{$i}' value='{$data['value']}'><input type='hidden' name='var{$i}_id' value='{$data['id']}'></td></tr>";
		}
		echo "<tr><td colspan='2'><div align='center'><input type='hidden' name='numEnt' value='{$numrows}'><input type='hidden' name='action' value='settingsmgr'><button type='submit' class='nav' name='saveSet' value='SaveSettings'>Save</button></div></td></tr>";

	} else {
		echo "<tr><td>No Settings in Database!</td></tr>";
	}
	} else {
		echo "<tr><td>No Settings in Database!</td></tr>";
	}
	echo "</form></table>";
}
?>