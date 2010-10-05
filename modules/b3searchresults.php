<?php
define("IGNORE_CONFIG", true);
function b3searchresults()
{
		$stype = $_REQUEST['stype'];
		$sparm = $_REQUEST['sparm'];
		include("../classes/config_inc.php");
		if ($sparm != "") {
		echo "<div align='center'><table><td><tr><table class='container9'><tr><td colspan='13'><div align='center'><strong>B3 Player Search</strong></div></td></tr>";
		echo "<tr><td><strong>ID</strong></td><td>&nbsp;&nbsp;</td><td><strong>Name</strong></td><td>&nbsp;&nbsp;</td><td><strong>IP</strong></td><td>&nbsp;&nbsp;</td><td><strong>GUID</strong></td><td>&nbsp;&nbsp;</td><td><strong>Group</strong></td><td>&nbsp;&nbsp;</td><td><strong>Added on</strong></td></tr>";
		echo "<tr><td colspan='13' bgcolor='black' height='1'></td></tr>";
		$matchall = $_REQUEST['match'];
		if ($matchall == "") {
			$sql = "Select * From `clients` Where `{$stype}` LIKE '%{$sparm}%'";
		} else {
			$sql = "Select * From `clients` Where `{$stype}`='{$sparm}'";
		}
		mysql_connect("$b3db_host", "$b3db_user", "$b3db_pass") or die(mysql_error());
		mysql_select_db("$b3db_database") or die(mysql_error());
		$result = mysql_query($sql);
		if ($result) {
			if (mysql_num_rows($result) > 0) {
				while ($data=mysql_fetch_assoc($result)){
					$pid = $data['id'];
					$pip = $data['ip'];
					$pguid = $data['guid'];
					$pname = $data['name'];
					$pgbit = $data['group_bits'];
					$padded = date('h:i A T M d, Y', $data['time_add']);
					$pgroup = getgroup($pgbit);
					$aliases = getalias($pid);
					$penalties = getpenalties($pid);
					echo "<tr><td>{$pid}</td><td>&nbsp;&nbsp;</td>
					<td>".strip_gtlt($pname)."</td><td>&nbsp;&nbsp;</td>
					<td>{$pip}</td><td>&nbsp;&nbsp;</td>
					<td><font size='1'>{$pguid}</font></td><td>&nbsp;&nbsp;</td>
					<td>{$pgroup}</td><td>&nbsp;&nbsp;</td>
					<td><font size='1'>{$padded}</font></td>
					</tr>";
					echo "<tr><td colspan='5'>{$aliases}</td>
					<td>&nbsp;&nbsp;</td>
					<td colspan='5'>{$penalties}</td></tr>";
					echo "<tr><td colspan='13' bgcolor='white' height='1'></td></tr>";
				}
				echo "</table></div>";
				return;
			}
		}
		if($stype == "name") {
			$possibleids = getposids($sparm);
			if ($possibleids) {
				foreach($possibleids as $id) {
					mysql_connect("$b3db_host", "$b3db_user", "$b3db_pass") or die(mysql_error());
					mysql_select_db("$b3db_database") or die(mysql_error());
					$sql = "Select * from `clients` where `id`='{$id}'";
					$result = mysql_query($sql);
					if ($result) {
						if (mysql_num_rows($result) > 0) {
							while ($data=mysql_fetch_assoc($result)){
								$pid = $data['id'];
								$pip = $data['ip'];
								$pguid = $data['guid'];
								$pname = $data['name'];
								$pgbit = $data['group_bits'];
								$padded = date('h:i A e M d, Y', $data['time_add']);
								$pgroup = getgroup($pgbit);
								$aliases = getalias($pid);
								$penalties = getpenalties($pid);
								echo "<tr><td>*{$pid}</td><td>&nbsp;&nbsp;</td>
								<td>".strip_gtlt($pname)."</td><td>&nbsp;&nbsp;</td>
								<td>{$pip}</td><td>&nbsp;&nbsp;</td>
								<td><font size='1'>{$pguid}</font></td><td>&nbsp;&nbsp;</td>
								<td><font size='1'>{$pgroup}</font></td><td>&nbsp;&nbsp;</td>
								<td>{$padded}</td>
								</tr>";
								echo "<tr><td colspan='5'>{$aliases}</td>
								<td>&nbsp;&nbsp;</td>
								<td colspan='5'>{$penalties}</td></tr>";
								echo "<tr><td colspan='13' bgcolor='white' height='1'></td></tr>";
							}
							
						}
					}
					
				}
			} else {
				echo "<tr><td colspan='13'> No Results</td></tr>";
			}
			echo "</table>
			<br><font color='white'>* items are results of cross referencing aliases to clients, this happens when there are no results for your initial search
			</font></div>";
			return;
		}
		echo "<tr><td colspan='13'>No Results</td></tr>";
		echo "</table></div>";
		}
}
function getalias($id) {
	include("../classes/config_inc.php");
	mysql_connect("$b3db_host", "$b3db_user", "$b3db_pass") or die(mysql_error());
	mysql_select_db("$b3db_database") or die(mysql_error());
	$sql = "select * from `aliases` where `client_id`='{$id}'";
	$result = mysql_query($sql);
	if ($result) {
		$num = mysql_num_rows($result);
		if ($num > 0) {
			$i = 1;
			$alias = "Aliases({$num}): ";
			$aliases = array();
			while($data=mysql_fetch_assoc($result)){
				$aliases[] = $data['alias'];
			}
			$alias .= implode(", ", $aliases);
			return $alias;
		}
	}
	return "Aliases: No Aliases.";
}
function getgroup($id) {
	include("../classes/config_inc.php");
	mysql_connect("$b3db_host", "$b3db_user", "$b3db_pass") or die(mysql_error());
	mysql_select_db("$b3db_database") or die(mysql_error());
	$sql = "select * from `groups` where `id`='{$id}' LIMIT 1";
	$result = mysql_query($sql);
	if ($result) {
		$num = mysql_num_rows($result);
		if ($num == 1) {
			$data = mysql_fetch_assoc($result);
			return $data['name'];
		}
	}
	return $id;
}
function getpenalties($id) {
	include("../classes/config_inc.php");
	mysql_connect("$b3db_host", "$b3db_user", "$b3db_pass") or die(mysql_error());
	mysql_select_db("$b3db_database") or die(mysql_error());
	$sql = "select * from `penalties` where `id`='{$id}'";
	$result = mysql_query($sql);
	if ($result) {
		$num = mysql_num_rows($result);
		if ($num > 0) {
			$pen = array();
			$penalty = "Penalties({$num}): ";
			while($data=mysql_fetch_assoc($result)){
				$pen[] = $data['type'];
			}
			$penalty .= implode(", ", $pen);
			return $penalty;
		}
	}
	return "Penalties: No penalties.";
}
function getposids($name) {
	$matchall = $_REQUEST['match'];
	include("../classes/config_inc.php");
	if ($matchall == "") {
		$sql = "Select * From `aliases` where `alias` LIKE '%{$name}%'";
	} else {
		$sql = "Select * From `aliases` where `alias`='{$name}'";
	}
	mysql_connect("$b3db_host", "$b3db_user", "$b3db_pass") or die(mysql_error());
	mysql_select_db("$b3db_database") or die(mysql_error());
	$result = mysql_query($sql);
	if ($result) {
		$num = mysql_num_rows($result);
		if ($num > 0) {
			$pos = array();
			while($data=mysql_fetch_assoc($result)) {
				$pos[] = $data['client_id'];
			}
			return $pos;
		}
	}
	return false;
	
}
?>