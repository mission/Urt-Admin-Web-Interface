<?php
$q=$_GET["q"];
define('INCLUDE_CHECK',true);
include("config_inc.php");
$con = mysql_connect("$db_host", "$db_user", "$db_pass");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("$db_database",$con);

$sql="SELECT * FROM ".$db_prefix."_servers WHERE `id`='$q' LIMIT 1";

$result4 = mysql_query($sql);
$row = mysql_fetch_array($result4);
$sid = $row['id'];
$sname = $row['name'];
$sip = $row['ip'];
$sport = $row['port'];
$srcon = $row['rconpass'];
$sstatus = $row['Status'];
  
require('q3status.php');
$s = new q3status("$sip", "$sport"); // Create a new q3status with the server IP, Port.
$result5 = $s->update_status(); // Get the status from the server so we can go through cvars and players.
$nump = $s->get_num_players();
//$nump =($nump-1);
if ($nump == "0") {
echo "<div class='container4'>";
echo "<h2>" . $sname . " is currently Empty</h2>";
echo "</div>";
} elseif ($nump == "-1") {
echo "<div class='container4'>";
echo "<h2>" . $sname . " is currently <font color='red'>offline</font></h2>";
echo "</div>";
} else {
include("q3rcon.php");
$r = new q3rcon("$sip", "$sport", "$srcon");
$maxcl = $s->cvarlist['sv_maxclients'];
$prcl = $s->cvarlist['sv_privateclients'];
$max = ($maxcl-$prcl);
echo "<table class='container4'><tr><td><table>";
echo "<tr><td colspan='7'><div align='center'>$sname  &nbsp;&nbsp;Players: $nump/$max</div></td></tr>";
echo "<tr>
<th>Slot#</th><th>&nbsp;&nbsp;</th><th>Name</th><th>&nbsp;&nbsp;</th><th>IP:</th><th>&nbsp;&nbsp;</th><th>GUID:</th><th>&nbsp;&nbsp;</th><th>Action</th></tr>";
include("functions2.php");
$ver = $s->cvarlist['version'];
$alpha = "|ALPHA|";
if (strpos($ver, $alpha) !== false) {
	$players = getplist2("$sip", "$sport", "$srcon");
	foreach($players as $player)
	{
		list($slotnum, $sinfo) = explode(':', $player, 2);
		list($name, $sinfo) = explode('^7', $sinfo, 2);
		$sinfo = explode(" ", $sinfo);
		$guid = $sinfo[2];
		$ip = $sinfo[1];
		$name2 = trim($name, " ");
		if ($slotnum !== '') {
		echo "<tr>";
		echo "<td><font size='1'>$slotnum</font></td><td>&nbsp;&nbsp;</td><td><font size='1'>".strip_gtlt(strip_colors($name2))."</font></td><td>&nbsp;&nbsp;</td><td><font size='1'>$ip</font></td><td>&nbsp;&nbsp;</td><td><font size='1'>$guid</font></td><td>&nbsp;&nbsp;</td><td><form action='' method='post'><select name='do'><option selected=select>Select</option><option value='kick'>Kick</option><option value='slap1'>Slap(1)</option>";
		echo "<option value='runban'>Ban</option>";
		echo "</select><input type='hidden' name='svip' value='$sip' /><input type='hidden' name='svport' value='$sport' /> <input type='hidden' name='svrcon' value='$srcon' /><input type='hidden' name='plname' value='".strip_gtlt(strip_colors($name2))."' /><input type='hidden' name='plip' value='$ip' /><input type='hidden' name='plslot' value='$slotnum' /><input type='hidden' name='svid' value='$q' /><input type='submit' class='nav' value='Execute' /></form></td>";
		echo "</tr>";
		}

	}
} else {
	$players = getplist("$sip", "$sport", "$srcon");
	foreach($players as $player)
	{
		echo "<tr>";
		$slotnum = $player['num'];
		$name2 = $player['stripped_name'];
		$plguid = $player['guid'];
		list($ip) = explode(":", $player['address'], 2);
		echo "<td><font size='1'>$slotnum</font></td><td>&nbsp;&nbsp;</td><td><font size='1'>".strip_gtlt(strip_colors($name2))."</font></td><td>&nbsp;&nbsp;</td><td><font size='1'>$ip</font></td><td>&nbsp;&nbsp;</td><td><font size='1'>$plguid</font></td><td>&nbsp;&nbsp;</td><td><form action='' method='post'><select name='do'><option selected=select>Select</option><option value='kick'>Kick</option><option value='slap1'>Slap(1)</option>";
		echo "<option value='runban'>Ban</option>";
		echo "<option value='namesearch'>Search PlayerName</option><option value='ipsearch'>Search IP</option></select><input type='hidden' name='svip' value='$sip' /><input type='hidden' name='svport' value='$sport' /> <input type='hidden' name='svrcon' value='$srcon' /><input type='hidden' name='plname' value=\"".strip_gtlt(strip_colors($name2))."\" /><input type='hidden' name='plip' value='$ip' /><input type='hidden' name='plslot' value='$slotnum' /><input type='hidden' name='svid' value='$q' /><input type='submit' class='nav' value='Execute' /></form></td>";
		echo "</tr>";
	}
}
echo "</table></tr></td></table>";

mysql_close($con);
}

?> 