<?php
/*
 * File: q3master.php
 * Description: Quake 3 Engine master server query class.
 * Author: Sean Cline (MajinCline)
 * License: You may do whatever you please with this file and any code it contains. It is to be considered public domain.
 */

class q3master {
    private $q3masterhost;
    private $q3masterport;
    private $q3protcolver;
    private $q3headerchars;
    private $q3responseheader;
    private $q3EOF;
    private $q3serverlength;

    public function __construct($masterhost, $masterport) {
      $this->logmsgq3masterhost = $masterhost;
      $this->logmsgq3masterport = $masterport;
    
      $this->logmsgq3protcolver = 68;
      $this->logmsgq3headerchars = str_repeat(chr(255), 4);
      $this->logmsgq3responseheader = $this->logmsgq3headerchars."getserversResponse\\";
      $this->logmsgq3EOF = "EOT".chr(0).chr(0);
      $this->logmsgq3serverlength = 6;
    }

    public function getServers() {
    
    // Grab an encoded server list from the master.
    $this->logmsg("Updating master server list.\n");
    $q3mastersock = fsockopen("udp://" . $this->logmsgq3masterhost, $this->logmsgq3masterport);
    $this->logmsg("Waiting for response from master: $this->logmsgq3masterhost\n");
    fwrite($q3mastersock, $this->logmsgq3headerchars."getservers 68 full empty");

    stream_set_timeout($q3mastersock, 1);
    $buffer = "";
    while ($buff = fread($q3mastersock, 16384)) {
      $buffers[] = $buff;
      //$this->logmsg("Packet received:\n" . $buff . "\n\n");
    }

    fclose($q3mastersock);
    
    // Loop over each packet adding more servers.
    $servers = array();
    foreach($buffers as $buffer) {
      $this->logmsg("Packet:\n" . str_replace("\n", " ", $buffer) . "\n\n");
      
      // See if the server sent back the proper header.
      if(strpos($buffer, $this->logmsgq3responseheader) == 0) {
        $this->logmsg("Server response recieved with proper header.\n");
      } else {
        $this->logmsg("Server response does not start with: $this->logmsgq3responseheader\n");
        continue;
      }
      
      // Cut the buffer up and get ready to read ip:ports
      $buffer = substr($buffer, strlen($this->logmsgq3responseheader));
      $rawips = str_split($buffer, 7);
      
      foreach ($rawips as $key => $value) {
        $serveraddr = $this->str2addr($value);
		//echo "<br>";
        if ($serveraddr != null) {
          $servers[$serveraddr] = ("$serveraddr");
		  
        }
      }
    }
    if (count($servers) == 0) {
      $this->logmsg("No servers available for: $this->logmsgq3masterhost:$this->logmsgq3masterport");
    }
    return $servers;
    
  }

  public function str2addr($str) {
    $addrlen = strlen($str);
    if ($addrlen < 6 || strpos($str, $this->q3EOF) === 0) {
      $this->logmsg("Error: Host string length too small or is an EOF.\n");
      return null;
    } elseif ($addrlen > 6) {
      if (substr($str, -1) == '\\' && $addrlen == 7) {
        $this->logmsg("Notice: Host string ends in \\. This is expected.\n");
      } else {
        $this->logmsg("Warning: Host string length is larger than expected.\n");
      }
    }
    
    $outputhost = ""; // A place to store the ip we are building.
    
    // Parse for the IP address
    for ($i=0; $i<4; $i++) {
      if ($i != 0) {
        $outputhost .= '.';
      }
      $outputhost .= ord(substr($str, $i, 1)); // Add an octet to the output
      
      $this->logmsg(substr($str, $i, 1) . ": " . ord(substr($str, $i, 1)) . "\n");
    }
    
    // Parse for the port
    $port = 0;
    $port += 256 * ord(substr($str, 4, 1));
    $port += ord(substr($str, 5, 1));
    
    if($port == 0) {
      return null;
    }
    
    $outputhost .= ':' . $port; // Add the port to the output
    return $outputhost;
  }
  
  public function logmsg($msg) {
    //echo $msg; // Uncomment this line to enable printing out debug messages
  }
}

?>
