<?php
function adminmenu()
{

include("classes/config_inc.php");
$link2 = mysql_connect($db_host,$db_user,$db_pass) or die('Unable to establish a DB connection');
mysql_select_db($db_database,$link2);
$sql2 = "SELECT * FROM `".$db_prefix."_mainmenu` WHERE `type`='adminmenu' order by `order` ASC";
$result2 = mysql_query($sql2);
if (!$result2) {
echo "Your Admin menu has 0 links!<br>";
}
while($row2 = mysql_fetch_assoc($result2))
{
$name = $row2['name'];
$href = $row2['href'];
$link = "<a href='".$href."'>$name</a><br />";
echo "$link";
}
}
?>