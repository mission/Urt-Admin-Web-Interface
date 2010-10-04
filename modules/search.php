<?php
define('INCLUDE_CHECK',true);
include("../classes/functions2.php");
include("../classes/functions.php");
require '../classes/q3status.php';
require '../classes/q3rcon.php';
include("searchform.php");
include("searchresults.php");
$theme = $_COOKIE['currenttheme'];?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"../templates/$theme/style.css\" media=\"screen\" />";?>
</head>
<body>
<?php
$sparm = $_REQUEST['sparm'];
echo "<div align='center'>";
echo searchform();
echo '<br><a href="javascript:self.close()">close window</a>';
echo "</div>";
echo searchresults();

?>
</body>
</html>