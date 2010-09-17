<?php

if(!defined('INCLUDE_CHECK')) die('You are not allowed to execute this file directly');
//Config file
//site url
$site_loc = "http://example.com/urtadmin/";

// Header output
$header1 = "<strong>Welcome to the New Server Administrator Site!</strong>"; //header
$subhead = "This is under construction still!"; //sub header
$header2 = "<strong>Welcome to the New Server Administrator Site!</strong>";
$subhead2 = "This is under construction still!";
$title = "Administrators Site";
//content output, boddy2 is used for when the user isnt logged in
$body = "<strong>This is the body of the site!</strong>"; //body

$body2 = "<strong>Please Login to Access the site and its features!</strong>"; //body2

//footer output
$footer = ""; //footer
$footer2 = "<strong>You are not logged in....</strong>"; //footer2

//This turns on ip check - only pre-registered members will be able to access the site, all others will receive an error message and a big stop sign
$ipcheckon = "on";
//This turns on banning through this admin interface
$ban_status = "on";
//redirect url for when banning is off, when banning it will redirect to this url with ?ip=<playerip>&name=<playername>
//appended to the url, unless u just click the ban link in the main menu.
$redirect_url = "";

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
?>