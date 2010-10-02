<?php
function themes()
{
	include("classes/config_inc.php");
	$link = mysql_connect($db_host,$db_user,$db_pass) or die('Unable to establish a DB connection');
	mysql_select_db($db_database,$link);
	$sql = "SELECT * FROM `".$db_prefix."_styles`";
	$result = mysql_query($sql);
	if (!$result) {
		echo "0 Themes installed!<br>";
	} else {
		echo "<div align='center'><font color='#FF4E00'><strong>Theme:</strong></font><br><form action='' method='post'><select name='settheme'>";
		echo "<option>Select</option>";
		while($row = mysql_fetch_assoc($result))
		{
			$name = $row['name'];
			$folder = $row['folder'];
			echo "<option value='{$folder}'>{$name}</option>";
		}
		echo "</select>&nbsp;<input type='submit' class='nav' value='Set' /></form><br>Current: {$_SESSION['theme']}</div>";
	}
}
?>