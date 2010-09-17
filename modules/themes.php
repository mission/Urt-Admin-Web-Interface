<?php
function themes()
{
$theme1 = explode('/', $_SESSION['theme']);
echo "<div align='center'><form action='' method='post'><select name='settheme'>";
echo "<option>Select</option>";
echo "<option value='templates/default/style.css'>Default</option>";
echo "</select><input type='submit' value='Set' /></form><br>Current: ".$theme1[1]."</div>";
}
?>