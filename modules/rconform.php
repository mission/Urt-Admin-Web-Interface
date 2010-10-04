<?php
function rconform()
{
	include("../classes/config_inc.php");
	echo "<form method='post' action=''><table class='container8'><tr><td>";
    echo "<table><tr><td colspan='2'><div align='center'><font size='4'><strong>Run RCON Command</strong></font></div></td></tr><tr><td><div align='right'>Server:</div></td><td><div align='left'>";
	echo "<select name='rconserver'><option selected='selected'>Select</option>";
	mysql_connect("$db_host", "$db_user", "$db_pass") or die(mysql_error());
	mysql_select_db("$db_database") or die(mysql_error());
	$sql="SELECT * FROM `".$db_prefix."_servers` where `Status`='Online' order by `order` ASC";
	$result =mysql_query($sql);
	while ($data=mysql_fetch_assoc($result)){
	$svname = $data['name'];
	$svname = stripslashes($svname);
	$svid = $data['id'];
	if ($svname == $server3) {
	$selected = "selected=\"$svname\"";
	} else {
	$selected = "";
	}
	echo "<option value =\"$svid\" $selected>$svname</option>";
	} 
	echo "</select></div></td></tr><tr><td><div align='right'>Rcon Command:</div></td><td><div align='left'><input type='text' name='rconc'></div></td></tr><tr><td colspan='2'><div align='center'><input type='submit' value='Execute'></div></td></tr></table></td></tr></table></form>";
}
?>