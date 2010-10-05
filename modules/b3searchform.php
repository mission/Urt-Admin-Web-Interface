<?php
function b3searchform() {
	echo "<form method='post' action=''><table class='container8'><tr><td><table><tr><td colspan='2'><div align='center'><font size='4'><strong> Player Search </font></div></td></tr>";
	echo "<tr><td><div align='right'>Search Type:</div></td><td><div align='left'><select name='stype'><option value='name' selected='name'>Player Name</option><option value='ip'>Player IP</option><option value='guid'>Player GUID</option></select></div></td></tr>";
	echo "<tr><td><div align='right'>Search:</div></td><td><div align='left'><input type='text' name='sparm'></div></td></tr>";
	echo "<tr><td colspan='2'><div align='center'>Exact Match: <input type='checkbox' value='yes' name='match'>&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' value='Search'></div></td></tr>";
	echo "</table></td></tr></table></form>";

}
?>