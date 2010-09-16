<?php
/*
 * File: q3status.php
 * Description: Quake 3 Engine status class for PHP
 * Author: Sean Cline (MajinCline)
 * License: You may do whatever you please with this file and any code it contains. It is to be considered public domain.
 */

class q3status {
        // Some vars that will be used to hold players and cvars
        public $playerlist;
        public $cvarlist;
        public $last_server_status;

        // Some vars to store what server we will connect to
        private $address;
        private $port;
        private $socket_connection;
        private $timeout;

        // Misc. other vars
        private $last_socket_err_num;
        private $last_socket_err_str;

        // Constructor: takes the IP address (or hostname), port, timeout in ms
        // the server and opens a connection.
        public function __construct($serv_address, $serv_port, $timeout=2000) {
                // Init the vars first
                $this->playerlist = array();
                $this->cvarlist = array();
                $this->last_server_status = "";
                
                $this->address = $serv_address;
                $this->port = intval($serv_port);
                $this->timeout = $timeout;
                
                $this->last_socket_err_num = -1;
                $this->last_socket_err_str = "";

                // Open up the connection wih the given address and port
                $this->socket_connection = fsockopen("udp://" . $this->address, $this->port, $this->last_socket_err_num, $this->last_socket_err_str);
                if (!$this->socket_connection) {
                        die("Could not connect with given ip:port\n<br>errno: $this->last_socket_err_num\n<br>errstr: $this->last_socket_err_str");
                }

        }

        // Precondition: A socket has been opened without error by the constructor
        // Postcondidtion: The given command will be sent and a response will be
        //      recoverable from the function get_response()
        private function send_command() {
                fwrite($this->socket_connection, str_repeat(chr(255), 4) . "getstatus\n");
        }

        // Get the server's response to our previous query.
        // Precondition: A command should have already been sent with send_command($cmd).
        // Postcondidtion: The server's response string will be returned.
                
		public function get_response(&$er = false) {
                $er = false;
                stream_set_timeout($this->socket_connection, 0, 500000);
                $buffer = "";
                while ($buff = fread($this->socket_connection, 9999)) {
                        if(!substr($buff, 4, 8) == "print"){
                           $er = true;
                        }
                        $buffer .= substr($buff, 4 + 6);
                }
                return $buffer;
        }

        // Get the status and parse it into a player and cvar array.
        // Returns true on success, false on failure.
        public function update_status() {
              // Get the status string from the server
              $this->send_command();
              $this->last_server_status = $this->get_response();
              
              if($this->last_server_status == "") {
                    return false;
              }
              
              // Break the status string into it's "paragraphs"
			  $data = explode("\n", $this->last_server_status, 2);
			  $data2 = explode("\n", $data[1], 2);
			  $cvars = $data2[0];
			  $players = $data2[1];
              // Load the cvars into an array for fast access later.
              $cvararray = array();
              $cvarexplode = explode("\\", $cvars);
              for($i = 1; $i<count($cvarexplode); $i++) { // start at 1 because the cvar string starts with a \
                    $cvararray[$cvarexplode[$i]] = strip_colors($cvarexplode[++$i]); // Load each the array into a cvarname=>cvarvalue array
              }
              
              // Load the players into an array.
              $playerarray = array();
              $playerexplode = explode("\n", $players);
              for($i = 0; $i<count($playerexplode); $i++) {
                    $playerline = trim($playerexplode[$i]);
                    if($playerline != "") { // Make sure this isn't an empty line.
                          list($score, $ping, $name) = explode(" ", $playerline, 3); // Break the player into attributes
                          $name = substr($name, 1, strlen($name) - 2);
                          // Load each the array into a playernumber=>array('name'=>playername, 'strippedname'=>strippedplayername, 'ping'=>playerping, 'score'=>playerscore) array
                          $playerarray[$i] = array('name' => $name, 'strippedname' => strip_colors($name), 'ping' => intval($ping), 'score' => intval($score));
                    }
              }
              
              $this->cvarlist = $cvararray;
              $this->playerlist = $playerarray;
              
              return true;
        }

        // Get the number of players in the server.
        public function get_num_players() {
                if (is_array($this->playerlist)) {
                        return count($this->playerlist);
                } else {
                        return 0;
                }
        }

        // Return the Host:Port of this server
        public function get_address() {
                return $this->address . ":" . $this->port;
        }

        // Get a cvar by name, empty string for not found.
        public function get_cvar($name) {
                if(array_key_exists($name, $this->cvarlist)) {
                        return $this->cvarlist[$name];
                } else {
                        return "";
                }
        }
		
		public function get_players() {
			return $this->playerlist;
		}

        public function close() {
                fclose($this->socket_connection);
        }
}

// Remove ^# colors
function strip_colors($str) {
      return preg_replace("/\^./","", $str);
}
// Replace < and >
function strip_gtlt($str) {
	$test = "<";
	$pos = strpos($str, $test);
	if ($pos !== false) {
		$str = str_replace("<", "&lt;", $str);
		$test = ">";
		$pos2 = strpos($str, $test);
		if ($pos2 !== false) {
			$str = str_replace(">", "&gt;", $str);
		}
	} else {
		$test = ">";
		$pos2 = strpos($str, $test);
		if ($pos2 !== false) {
			$str = str_replace(">", "&gt;", $str);
		}
	}
	return $str;

}

?>
