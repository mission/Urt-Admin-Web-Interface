<?php
function bansearchresult() {
			$name = $_REQUEST['name'];
			$ip = $_REQUEST['ip'];
			$creator = $_REQUEST['creator'];
			$search = $_REQUEST['search'];
			if ($name == "" and $ip == "") {
			$field = "admin";
			$sparm = "$creator";
			} elseif ($name == "" and $creator == "") {
			$field = "ip";
			$sparm = "$ip";
			} else {
			$field = "player";
			$sparm = "$name";
			}
			$name = $_REQUEST['name'];
			$ip = $_REQUEST['ip'];
			$creator = $_REQUEST['creator'];
			 
			if ($user == "") {
				$user = "system";
			}

			 if ($search != "") {
				if ($sparm == "") {
					echo "<div class='container9'>Please enter a Players name or ip</div>";
					die("&nbsp;");
				}
				echo "<div class='container9'>Search Results:";
				sleep(1);
				define("INCLUDE_CHECK", true);
				include "../classes/config_inc.php";
				mysql_connect("$db_host", "$db_user", "$db_pass") or die(mysql_error());
				mysql_select_db("$db_database") or die(mysql_error());
				$sql3 = "SELECT *
				FROM `".$db_prefix."_bans`
				WHERE $field LIKE CONVERT( _utf8 '%$sparm%'
				USING latin1 )
				COLLATE latin1_swedish_ci";
				$result = mysql_query($sql3);
				if (!$result) {
					die("No Players with $field matching $sparm");
				}

				$fields_num = mysql_num_fields($result);


				echo "<table><tr>";
				for($i=0; $i<$fields_num; $i++)
				{
					$field = mysql_fetch_field($result);
					echo "<td>{$field->name}</td>";
				}
			 echo "</tr>\n";
			 // printing table rows
			 while($row = mysql_fetch_row($result))
			 {
				echo "<tr>";

				foreach($row as $cell)
					echo "<td>$cell</td>";

				echo "</tr>\n";
		 	 }
			 mysql_free_result($result);
			 echo "</table></div>";
			 }

}

?>