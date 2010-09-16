=== README ===
=== UrtAdmin Web Interface ===
== By: |ALPHA|mission ==
== Website: www.dejgaming.com ==
== 09/16/2010 ==

Copyright (c) 2010 |ALPHA| Mission <dejgaming@gmail.com>

This program is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY: without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Pulbic License along with this program. If not, see http://www.gnu.org/licenses/.

===Install===
1. put the content of this zip file in a folder on your webserver
2. create a database, edit config_inc.php to your desired settings
3. import the urtadmin.sql file thats located in the sql folder into your mysql database
4. open ur browser to the admin directory and use the form to add admin accounts
5. add a cron job that loads classes/getPlayers.php every x minutes, this script cycles through the servers entered in the 
database and gets the current players, then adds them to the database
DONE! :)
==============
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
