=== README ===
=== UrtAdmin Web Interface ===
== By: |ALPHA|mission ==
== Website: www.dejgaming.com ==
== 09/16/2010 ==

Copyright (c) 2010 |ALPHA| Mission <dejgaming@gmail.com>

This program is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY: without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Pulbic License along with this program. If not, see http://www.gnu.org/licenses/.

Update: 09/16/2010
==================
you can now use the ts3 module! first import the urtadmin_ts3.sql file into your database, then add a cron job that runs the updatets3.php script every x minutes. now just add the ts3 module entry in your modules table, requiredarg1 = serverip, requiredarg2 = server port, requiredarg3 = virtual server id.

You can also now use the serverview module. The serverview module displays the servername, number of players, map screenshot, and list of players and there scores, and the /connect info. the map screenshots have been included, please read the README.txt file included in the mapshots folder.
To use: import the urtadmin_status.sql file into your database, then add a cron job that runs the getstatus.php script(this script will cycle through all the servers that are set to Online status in the servers table) now just add an new entry into the modules table, requiredarg1 = ip, requiredarg2 = port, requiredarg3 = Not used. You may wanna play around with the different positions.


Note: valid pos entries for modules table: news, reg, admin, left, body, user1, user2, user3, and footer


===Install===
Warning: this requires a mysql database

1. put the content of this zip file in a folder on your webserver
2. create a database, edit config_inc.php to your desired settings
3. import the urtadmin.sql file thats located in the sql folder into your mysql database
4. open ur browser to the admin/add.php and use the form to add the first admin account, delete/rename add.php, then just use <site>/admin/ to add/edit/delete users using the User Manager.
5. in the backend interface click server manager, and add/edit/delete your server from there.
5. add a cron job that loads classes/getPlayers.php every x minutes, this script cycles through the servers entered in the 
database and gets the current players, then adds them to the database
DONE! :)
==============

===Update v1.0 to v1.1===
1. put the content of this zip file in to your existing site install(backup your config 
so you can refer to it later for your settings since there is a new config_inc.php that needs to be used).
2. open the new config_inc.php and edit the database settings to match your db settings in your old config_inc.php, save.
3. import the updatev1.0-to-v1.1.sql into your current database.
4. rename/delete the add.php file located in the admin folder
5. open browser to <site>/admin/ and click the new Settings Manager, change the settings to match your previous ones
(which is where backing up your old config_inc.php makes this easy)
Done!

===Using B3 database search module===
This currently only works for one database(however with editing you can make copies of this to use for more than one)
1. open config_inc.php, edit the new b3 db settings to match your b3 bots database
2. add a menu item from the menu manager, for href type javascript:PopUp("modules/b3search.php")
Done :)
click the new menu item on the main site and it should popup a new window with a search form, when u do a search, if there are no results,
it will try to cross reference the aliases and clients tables, to find possible matches.

Creating Modules:
when u create a module, make the function that is inside the same name as the filename without the extension.
for example: say i have a module named ts3.php, the function inside would be: function ts3(<whatever # of vars>)
remember to add it to the database.
Also in the database the requiredarg1-3 are used for your modules if the function they contain uses an argument variable, 
then u would put that value into one of the requiredarg spots

Adding New Style(located in templates folder):
copy the contents of the default folder in the templates folder, to a new folder.
edit the contents of style.css and/or add images
open themes.php located in the modules folder
add another option to the select menu for your new style: say your style is called Urt, 
you would add echo "<option value='templates/Urt/style.css'>Urt</option>"; below the default entry

need help?
hit me up on the urbanterror.info forums: forum name: mission85
irc: GameSurge: #alphaclan, #dejgaming, #urtalphaclan
BTW, edit whatever you want!
