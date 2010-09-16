<?php
/*
 * File: q3dbexample.php
 * Description: Quake 3 Engine searchable player database usage example.
 * Author: Sean Cline (MajinCline)
 * License: You may do whatever you please with this file and any code it contains. It is to be considered public domain.
 */
require("q3db.php");

$serverdatabase = new q3db("master.urbanterror.net", 27950);
$serverdatabase->updateDB();

//echo "Looking up all players containing: skv.";
//$hits = $serverdatabase->lookupPlayer("skv.");
//echo "Search completed in " . ($serverdatabase->lastsearchend - $serverdatabase->lastsearchstart) . " seconds with " . count($hits) //. " results.\n";
//foreach($hits as $key => $entry) {
//   echo "Name: " . str_pad($entry["name"], 16) . "  Server: " . str_pad($entry['server']->get_address(), 22) . strip_colors($entry[///'server']->get_cvar('sv_hostname')) . "\n";
//}

//echo "\n------------\n";

//echo "Looking up all players containing: wtf";
//$hits = $serverdatabase->lookupPlayer("wtf");
//echo "Search completed in " . ($serverdatabase->lastsearchend - $serverdatabase->lastsearchstart) . " seconds with " . count($hits) //. " results.\n";
//foreach($hits as $key => $entry) {
//   echo "Name: " . str_pad($entry["name"], 16) . "  Server: " . str_pad($entry['server']->get_address(), 22) . strip_colors($entry[//'server']->get_cvar('sv_hostname')) . "\n";
//}

echo "<br>------------<br>";

echo "Looking up all servers containing: |ALPHA|";
$hits = $serverdatabase->lookupServer("|ALPHA|");
echo "Search completed in " . ($serverdatabase->lastsearchend - $serverdatabase->lastsearchstart) . " seconds with " . count($hits) . " results.<br><br>";
foreach($hits as $key => $server) {
   echo str_pad($server->get_address(), 21) . " Players: " . $server->get_num_players() . "/" . $server->get_cvar("sv_maxclients"). "   " . strip_colors($server->get_cvar('sv_hostname')) . "";
	echo "<br>";
}
   


echo "<br>------------<br>";

?>
