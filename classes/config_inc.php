<?php

if(!defined('INCLUDE_CHECK')) die('You are not allowed to execute this file directly');
//Config file

/* Database config */
$db_host		= 'localhost';
$db_user		= '';
$db_pass		= '';
$db_database	= '';
$db_prefix	= 'urtAdmin'; //LEAVE THIS ALONE! DO NOT EDIT unless u hand created the tables and used a different prefix
//name of table used for logins
$db_table		= $db_prefix.'_users';

/*end config */

$link = mysql_connect($db_host,$db_user,$db_pass) or die('Unable to establish a DB connection');
mysql_select_db($db_database,$link);
mysql_query('SET names UTF8');
$result = mysql_query("select * from {$db_prefix}_settings");
if ($result) {
	if (mysql_num_rows($result) > 0) {
		while ($data=mysql_fetch_assoc($result)){
			$CONFIG[$data['var']] = $data['value'];
		}
	}
}
?>