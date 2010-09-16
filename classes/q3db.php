<?php
/*
 * File: q3db.php
 * Description: Quake 3 Engine searchable player database byt using q3master and q3status classes.
 * Author: Sean Cline (MajinCline)
 * License: You may do whatever you please with this file and any code it contains. It is to be considered public domain.
 */

require_once("q3status.php");
require_once("q3master.php");
//include("dbconnect.php");
$date = date('h:m:s m-d-Y');
class q3db {
  private $master;
  private $q3queries;
  private $serverlist;
  public $lastupdatestart;
  public $lastupdateend;
  public $lastsearchstart;
  public $lastsearchend;
  public function __construct($masterhost, $masterport) {
    $this->master = new q3master($masterhost, $masterport);
    $this->q3queries = array();
    $this->serverlist = array();
  }
  
  public function updateDB() {
    $this->lastupdatestart = time();
    $this->q3queries = array(); // Clear out the query array so it doesnt accumulate.
    $this->serverlist = array(); // Uncomment to retain servers.
    
    // Load in servers from master.
    $servers = $this->master->getServers();
    $this->serverlist = $servers; // Put in the new serverlist
    
    foreach($this->serverlist as $key => $server) {
      //$this->logmsg("<br>server:" . $server);
      list($serveradr, $serverport) = explode(":", $server, 2);
      $this->q3queries[$server] = new q3status($serveradr, $serverport, 2000);
      
      $status = $this->q3queries[$server]->update_status();
      if ($status) {
	  	$svhost = "sv_hostname";
	  	//$hst = $this->logmsg("" . strip_colors($this->q3queries[$server]->("$svhost")));
		$hst = strip_colors($this->q3queries[$server]->get_cvar('sv_hostname'));
		$stripedname = strip_colors($query->get_cvar("sv_hostname"));
		$serverip = "$server";
		include "dbconnect.php";
        $this->logmsg("<br>Name: $stripedname $hst  Server: $server");
		$date= date('h:i:s a m-h-Y');
		mysql_connect("$db_host", "$db_user", "$db_pwd") or die(mysql_error());
		mysql_select_db("$database") or die(mysql_error());
		mysql_query("INSERT INTO `Servers` VALUES ('$hst', '$serverip', '$date')") or $this->logmsg("<br>server already added to database");
      } else {
        $this->logmsg("<br>Failed to get server info: $server");
      }
    }
    
    
    $this->lastupdateend = time();
  }

  public function lookupPlayer($name) {
    $name = strval($name);
    if ($name == "") {
      return array(); // If the input is uninteligable, dont search.
    }
    
    $this->lastsearchstart = time();
    $playerlist = array();
    foreach($this->q3queries as $key => $query) {
      foreach($query->playerlist as $key2 => $player) {
        //echo "player - " . $player['strippedname'] . "\n";
        if(stripos($player["strippedname"], $name) !== false) { // If the $name var is found anywhere in the colorstripped name of the current player, we have a match.
          $stripedname = strip_colors($query->get_cvar("sv_hostname"));
          echo "Found123 - " . $player['strippedname'] . "\n";
          $playerlistentry = $player;
          $playerlistentry['server'] = $query;
          $playerlist[] = $playerlistentry;
        }
      }
    }
      
    $this->lastsearchend = time();
    return $playerlist;
  }

  public function lookupServer($name) {
    $this->lastsearchstart = time();
    $serverlist = array();
    foreach($this->q3queries as $key => $query) {
      $stripedname = strip_colors($query->get_cvar("sv_hostname"));
      if(stripos($stripedname, $name) !== false) {
        //$this->logmsg("Match found: " . $query->get_cvar("sv_hostname"));
        $num_players = $query->get_num_players();
        $serverlist[] = $query;
      } else {
        //$this->logmsg("Match not found: " . $query->get_cvar("sv_hostname"));
      }
    }
      
    $this->lastsearchend = time();
    return $serverlist;
  }

  public function logmsg($msg) {
    echo $msg . "\n"; // Uncomment this line to enable printing out debug messages
  }
}
?>
