<?php
function rconresults() {
	include "../classes/config_inc.php";
	$server3 = $_REQUEST['rconserver'];
	$rconc = $_REQUEST['rconc'];
	echo "<div align='center'>";
	if ($server3 != "") {
	$server3 = addslashes($server3);
	mysql_connect("$db_host", "$db_user", "$db_pass") or die(mysql_error());
	mysql_select_db("$db_database") or die(mysql_error());
	$result = mysql_query("select * from {$db_prefix}_servers where `id`='{$server3}'");
	if (!$result) {
		die("No Server Available with id {$server3}");
	}
	
	$fields_num = mysql_num_fields($result);
	
	// store the record of the "example" table into $row
	$row = mysql_fetch_array( $result );
	// Print out the contents of the entry 

	$r = new q3rcon($row['ip'], $row['port'], $row['rconpass']);
	$data = explode(" ", $rconc);
	if ($data[0] == "kick" && count($data) > 2) {
		$data = explode(" ", $rconc, 3);
		$r->send_command("".$data[0]." ".$data[1]." \"".$data[2]."\"");
	} else {
		$r->send_command("$rconc");
	}
	$out = $r->get_response();

	$out2 = explode("\n", $out);
	echo "<table class='container9'><tr><td>";
	if ($out == '') {
		echo "Command Sent!";
	}
	foreach($out2 as $line) {
		if ($line != '') {
			echo "".strip_gtlt(strip_colors($line))."<br>";
		}
	}
	echo "</td></tr></table>";
	}
	echo "</div>";
}
?>