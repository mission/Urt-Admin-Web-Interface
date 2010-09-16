<?php
class ipcheck {
	public function checkip($ipcheck) {
		
		include "config_inc.php";
		mysql_connect($db_host,$db_user,$db_pass) or die(mysql_error());
		mysql_select_db($db_database) or die(mysql_error());
		$find = mysql_query("select `regIP` from ".$db_table." where `regIP`=\"$ipcheck\" limit 1");
		if (!$find) {
		die(mysql_error());
		}
		$count = mysql_num_rows($find);
		
		if ($count == "1") {
		$allowed='1';		
		} else {
		$allowed='0';
		}
		$a = new access();
		$a->allowed($allowed);
		}
}

class access {
	public function allowed($value) {
		if ($value == "0") { 
			echo "<div align='center'><font size='24'>Access Denied!</font><br><br>";
			echo "You are not allowed to be here!<br><br><img src='images/stop.png'/></div>";
			die();
		}
	}
}

?>