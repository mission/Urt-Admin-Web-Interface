<?php
function servermenu()
{
include("classes/config_inc.php");
$count = "0";
$link = mysql_connect($db_host,$db_user,$db_pass) or die('Unable to establish a DB connection');
mysql_select_db($db_database,$link) or die("Unable to select $db_database database");
$sql = "SELECT * FROM ".$db_prefix."_servers where Status='Online' ORDER BY `".$db_prefix."_servers`.`order` ASC";
$result = mysql_query($sql);
echo mysql_error();
if (!$result) {
}
while ($data=mysql_fetch_assoc($result))
{
$count++;
}
$count++;

echo "<div align='center'>";

$link = mysql_connect($db_host,$db_user,$db_pass) or die('Unable to establish a DB connection');
mysql_select_db($db_database,$link) or die("Unable to select $db_database database");
$sql = "SELECT * FROM ".$db_prefix."_servers Where Status='Online' ORDER BY `".$db_prefix."_servers`.`order` ASC";
$result = mysql_query($sql);
echo mysql_error();
if (!$result) {
echo "<option>0 servers</option>";
}
$div = "";
while ($data=mysql_fetch_assoc($result))
{
$svid = $data['id'];
$svname = $data['name'];
$div .= "<div id=\"$svid\" onclick=\"showUser($svid);highlightLink(this);\" value=\"$svid\">$svname</div>";
}
echo $div;
echo "</div>";
mysql_close($link);
}