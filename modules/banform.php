<?php
function banform() {
	include("classes/config_inc.php");
	$prebanip = $_GET['banip'];
	$prebanname = $_GET['banname'];
	if (strtolower($CONFIG['ban_status']) == "on") {
	echo "<div align='center'>";
	echo "<form action='' method='post'>";
	echo "<table class='container7'>";
	echo "<tr><td colspan='2'><div align='center'>Ban IP</div></td></tr><tr><td><div align='right'>Name:</div></td><td><input type='text' name='banname' value=\"$prebanname\"></td></tr>";
	echo "<tr><td><div align='right'>IP:</div></td><td><input type='text' name='banip' value='$prebanip'></td></tr><tr><td><div align='right'>Length:</div></td><td><select name='banlength'><option value='perm'>Perm</option></select>";
	echo "</td></tr><tr><td><div align='right'>Reason:</div></td><td><input type='text' name='banreason'></td></tr><tr><td colspan='2'>";
	echo "<input type='hidden' name='do' value='runban'><input type='submit' class='nav' value='Ban!'></td></tr></table></form>";
	echo "</div>";
	} else {
	echo "<strong><font color='red'> Banning is off</font></strong>";
	}
}
?>
