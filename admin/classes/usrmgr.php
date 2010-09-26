<?php

function Save($id, $usr, $pass, $email, $regip, $dt, $admin, $full, $theme) {
	include "../classes/config_inc.php";
	mysql_connect($db_host,$db_user,$db_pass) or die(mysql_error());
	mysql_select_db($db_database) or die(mysql_error());
	mysql_query("update {$db_table} set `usr`='{$usr}', `pass`='{$pass}', `email`='{$email}', `regIP`='{$regip}', `dt`='{$dt}', `admin`='{$admin}', `fullname`='{$full}', `theme`='{$theme}' where `id`='{$id}'") or die("Error saving changes!".mysql_error()."");
	echo "<table class='srvcontainer'><tr><td>Changes Saved!</td></tr></table>";
}

function editusr($id) {
	include "../classes/config_inc.php";
	mysql_connect($db_host,$db_user,$db_pass) or die(mysql_error());
	mysql_select_db($db_database) or die(mysql_error());
	$result = mysql_query("select * from ".$db_table." where `id`='{$id}' limit 1;");
	if (mysql_num_rows($result) > 0) {
		$data=mysql_fetch_assoc($result);
		echo "<form action='' method='post'>";
		echo "<table class='utilcontainer6'>";
		echo "<tr><td>Username:</td><td><input type='text' name='editUsrname' value='{$data['usr']}'></td></tr>";
		echo "<tr><td>Password:</td><td><input type='text' name='editUsrpass'></td></tr>";
		echo "<tr><td>Email:</td><td><input type='text' name='editUsremail' value='{$data['email']}'></td></tr>";
		echo "<tr><td>IP:</td><td><input type='text' name='editUsrip' value='{$data['regIP']}'></td></tr>";
		echo "<tr><td>RegDate:</td><td><input type='text' name='editUsrdate' value='{$data['dt']}'></td></tr>";
		echo "<tr><td>Admin[Yes/No]:</td><td><input type'text' name='editUsradmin' value='{$data['admin']}'></td></tr>";
		echo "<tr><td>Fullname:</td><td><input type'text' name='editUsrfull' value='{$data['fullname']}'></td></tr>";
		echo "<tr><td>Theme:</td><td><input type='text' name='editUsrtheme' value='{$data['theme']}'></td></tr>";
		echo "<input type='hidden' name='editUsrpassorig' value='{$data['pass']}'>";
		echo "<input type='hidden' name='editUsrid' value='{$data['id']}'>";
		echo "<input type='hidden' name='action' value='usrmgr'>";
		echo "<tr><td colspan='2'><input type='submit' name='saveusr' value='Save'></td></tr>";
		echo "</table>";
		echo "</form";
	} else {
		echo "Unable to edit user/invalid id";
	}
}

function deleteusr($id) {
	include "../classes/config_inc.php";
	mysql_connect($db_host,$db_user,$db_pass) or die(mysql_error());
	mysql_select_db($db_database) or die(mysql_error());
	mysql_query("delete from {$db_table} where id='{$id}'");
	echo "<table class='srvcontainer'><tr><td>User Deleted!</td></tr></table>";
}

function usrmgr()
{
	include "../classes/config_inc.php";
	mysql_connect($db_host,$db_user,$db_pass) or die(mysql_error());
	mysql_select_db($db_database) or die(mysql_error());
	
	if ($_REQUEST['saveusr'] != '') {
		if ($_REQUEST['editUsrpass'] != "") {
			$npass = md5($_REQUEST['editUsrpass']);
		} else {
			$npass = $_REQUEST['editUsrpassorig'];
		}
		echo $_REQUEST['saveusr']($_REQUEST['editUsrid'], $_REQUEST['editUsrname'], $npass, $_REQUEST['editUsremail'], $_REQUEST['editUsrip'], $_REQUEST['editUsrdate'], $_REQUEST['editUsradmin'], $_REQUEST['editUsrfull'], $_REQUEST['editUsrtheme']);
	} else if ($_REQUEST['newusr'] != '') {
		mysql_query('insert into `'.$db_table.'`(`usr`,`pass`,`email`,`regIP`,`dt`,`admin`,`fullname`,`theme`) values("'.$_REQUEST['newUsrname'].'", "'.md5($_REQUEST['newUsrpass']).'", "'.$_REQUEST['newUsremail'].'", "'.$_REQUEST['newUsrip'].'", "'.$_REQUEST['newUsrdate'].'", "'.$_REQUEST['newUsradmin'].'", "'.$_REQUEST['newUsrfull'].'", "'.$_REQUEST['newUsrtheme'].'")') or die("Error saving New user!: ".mysql_error()."");
	}
	echo "<form action='' method='post'>";
	echo "<table>";
	echo "<tr><td colspan='2'>New User:</td></tr>";
	echo "<tr><td>Username:</td><td><input type='text' name='newUsrname'></td></tr>";
	echo "<tr><td>Password:</td><td><input type='text' name='newUsrpass'></td></tr>";
	echo "<tr><td>Email:</td><td><input type='text' name='newUsremail'></td></tr>";
	echo "<tr><td>IP:</td><td><input type='text' name='newUsrip'></td></tr>";
	echo "<tr><td>RegDate:</td><td><input type='text' name='newUsrdate'></td></tr>";
	echo "<tr><td>Admin[Yes/No]:</td><td><input type'text' name='newUsradmin'></td></tr>";
	echo "<tr><td>Fullname:</td><td><input type='text' name='newUsrfull'></td></tr>";
	echo "<tr><td>Theme:</td><td><input type='text' name='newUsrtheme' value='templates/default/style.css'></td></tr>";
	echo "<input type='hidden' name='action' value='usrmgr'>";
	echo "<tr><td colspan='2'><button type='submit' name='newusr' value='newusr'>Submit</button></td></tr>";
	echo "</table>";
	echo "</form<br><br>";
	$result = mysql_query("select * from ".$db_table."");
	if (mysql_num_rows($result) > 0) {

		$fields_num = mysql_num_fields($result);

		echo "<h1>Users:</h1>";
		echo "<table class='utilcontainer6'><tr><td><table><tr>";
		// printing table headers
		for($i=0; $i<$fields_num; $i++)
		{
			$field = mysql_fetch_field($result);
			echo "<td>{$field->name}</td><td>&nbsp;&nbsp;</td>";
		}
		echo "<td>Option</td><td>&nbsp;&nbsp;</td>";
		echo "</tr>";
		while ($data=mysql_fetch_assoc($result))
		{
			$id = $data['id'];
			$usr = $data['usr'];
			$pass = $data['pass'];
			$email = $data['email'];
			$regIP = $data['regIP'];
			$dt = $data['dt'];
			$admin = $data['admin'];
			$fullname = $data['fullname'];
			$theme = $data['theme'];
			$svname = $data['name'];
			echo "<tr><td>{$id}</td><td>&nbsp;&nbsp;</td>
			<td>{$usr}</td><td>&nbsp;&nbsp;</td>
			<td>{$pass}</td><td>&nbsp;&nbsp;</td>
			<td>{$email}</td><td>&nbsp;&nbsp;</td>
			<td>{$regIP}</td><td>&nbsp;&nbsp;</td>
			<td>{$dt}</td><td>&nbsp;&nbsp;</td>
			<td>{$admin}</td><td>&nbsp;&nbsp;</td>
			<td>{$fullname}</td><td>&nbsp;&nbsp;</td>
			<td>{$theme}</td><td>&nbsp;&nbsp;</td>";
			echo "<td><form action='' method='post'>
			<button type='submit' id='action' name='action' value='editusr'>Edit</button><button type='submit' id='action' name='action' value='deleteusr'>Delete</button>
			<input type='hidden' name='entID' value='{$id}'></form></td><td>&nbsp;&nbsp;</td></tr>";
		}
		mysql_free_result($result);
		echo "</table></td></tr></table>";
	} else {
		echo "No Entries in the Database ".$db_database."<br>";
	}

}


?>