
TSStatus: Teamspeak 3 viewer for php5
-------------------------------------

Installation
------------

	- Extract the whole tsstatus directory from the the archive and upload it to your website root
	- Navigate to http://www.yoursite.com/tsstatus/tsstatusgen.php
	- You will get a red warning because the generator is disabled by default
	- To enable the generator you have to edit tsstatusgen.php and replace $enableGenerator = false; by $enableGenerator = true; on line 10
	- Now you can test and customize TSStatus.  The generator will output the php/html codes needed to display your Teamspeak server status.  
	- Don't forget to disable the script when you have done! 

Advanced usage
--------------
	
	decodeUTF8: convert special characters from UTF8
		$tsstatus->decodeUTF8 = true;
		$tsstatus->decodeUTF8 = false;

	imagePath: path to the TSStatus icons directory
		$tsstatus->imagePath = "/tsstatus/img/";

	clearServerGroupFlags: clear all server groups flags
		$tsstatus->clearServerGroupFlags();

	setServerGroupFlag: define a server group flag
		$tsstatus->setServerGroupFlag(6, 'servergroup_300.png');

	clearChannelGroupFlags: clear all channel groups flags
		$tsstatus->clearChannelGroupFlags();
	
	setChannelGroupFlag: define a channel group flag
		$tsstatus->setChannelGroupFlag(5, 'changroup_100.png');
		$tsstatus->setChannelGroupFlag(6, 'changroup_200.png');
	
	showNicknameBox: show/hide the nickname box
		$tsstatus->showNicknameBox = true;
		$tsstatus->showNicknameBox = false;
		
	timeout: The timeout, in seconds, for connect, read, write operations
		$tsstatus->timeout = 2;
	
	showPasswordBox: show/hide the password box
		$tsstatus->showPasswordBox = false; // never render the password box
		$tsstatus->showPasswordBox = true; // the box will be rendered only if the server have a password

	setLoginPassword: set the ServerQuery login/password 
		$tsstatus->setLoginPassword("ServerQueryLogin", "ServerQueryPassword");
	
	setCache: activate caching system to prevent bans from the server... you are banned extra_msg=you may retry in XXX seconds
		$tsstatus->setCache(5);
		$tsstatus->setCache(5, "/tmp/mycachefile");
		The first parameter is the cache time in seconds
		The second parameter is the file were the datas will be stored (.../tsstatus/tsstatus.php.cache if not specified)
		The cache file MUST be writable
		
	limitToChannels: define a list of channel to render, others will be ignored
		$tsstatus->limitToChannels(1, 5, 17); // only render channels with ids equal to 1, 5 and 17
 

Recognized Status
-----------------

	Clients:
		- client is talking
		- client is away
		- harware input muted
		- harware output muted
		- input muted
		- output muted
	
	Channels:
		- channel is full
		- passworded channel
		
Recognized flags
-----------------

	Clients:
		- Server admin
		- Channel admin
		- Channel operator
		
	Channels
		- default channel
		- passworded channel
		- moderated channel

TODO
----
	- Javascript integration like <script src="/tsstatus/tsstatusJS.php?server=myserver..."></script>
	- Sort mode for clients in channels: sort clients by name, groups, ... 

Contact
-------

	Sebastien Gerard <sebeuu@gmail.com>
	http://tsstatus.sebastien.me/
	
Changelog
---------

26/02/10:

	- work with BETA 18 servers
	- added showPasswordBox, setLoginPassword, setCache and limitToChannels methods. See "Advanced usage" section for more informations. All these new features are implemented in the generator.
	- as suggested by COOLover on the official Teamspeak forum, TSStatus now send servergrouplist and channelgrouplist commands and call setServerGroupFlag and setChannelGroupFlag according to the received datas.

26/12/09
	- tested with severs BETA 3,5,6,7,8
	- first release of the TSStatus generator script
	- added a new property, showNicknameBox, to show/hide the nickname box
	- improved error messages. sockets and Teamspeak servers errors are now displayed with the error message and error number 
	- added a timeout property for connect, read, write operations
	- properly disconnect from server and send the quit message
	- code cleanup
	 
23/12/09:

	- work with BETA 5 servers
	- added a decodeUTF8 method for specials chars
	 