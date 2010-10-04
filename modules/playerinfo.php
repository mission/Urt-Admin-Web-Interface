<?php
function playerinfo() {
	include "classes/doaction.php";
	include "classes/config_inc.php";
	echo "<div id='txtHint'>";
	$action = $_REQUEST['do'];
	$banip = $_REQUEST['banip'];
	$banname = $_REQUEST['banname'];
	$banreason = $_REQUEST['banreason'];
	$banlength = $_REQUEST['banlength'];
	$svid = $_REQUEST['svid'];
	$plname = $_REQUEST['plname'];
	$plslot = $_REQUEST['plslot'];
	$plip = $_REQUEST['plip'];
	if ($action == "slap1") {
		$d = new doaction();
		echo $d->slap1($plslot, $svid);
	} elseif ($action == "kick") {
		$d = new doaction();
		echo $d->kick($plslot, $svid);
	} elseif ($action == "runban") {
		if($CONFIG['ban_status'] == "Off") {
			$plname = urlencode($plname);
			$redir = "".$CONFIG['redirect_url']."?ip=".$plip."&name=".$plname."";
			echo msg_redirect("Loading Ban Form",$redir,"5");
		} else {
			$d = new doaction();
			if ($banip) {
				foreach($d->ban($banip, $banname, $banreason, $banlength,  $_SESSION['userFull']) as $key  =>  $value) {
					echo "$value";
				}
			} else {
				$plname = urlencode($plname);
				$redir = "".$site_loc."?banip=".$plip."&banname=".$plname."";
				echo msg_redirect("Loading Ban Form",$redir,"1");
			}
		}
	} elseif ($action == "ban") {
		if($CONFIG['ban_status'] != "On") {
			$plname = urlencode($plname);
			echo msg_redirect("Loading Ban Form","".$CONFIG['redirect_url']."?ip=$plip&name=$plname","5");
		}
	}
	echo "</div>";
}

function msg_redirect($msg,$url,$seconds){
         global $site_name, $site_url;

         echo "<html dir=\""._LTR_RTL."\">\n"
              ."<head>\n"
              ."<title>$site_name</title>\n"
              ."<meta http-equiv=\"Refresh\" content=\"$seconds; URL=$url\">\n"
              ."<meta http-equiv=\"Content-Type\" content=\"text/html; charset="._CHARSET."\">\n"
              ."<link rel=\"stylesheet\" href=\"style.css\" type=\"text/css\">\n"
              ."</head>\n\n"
              ."<body>\n"
              ."<br />\n"
              ."<br />\n"
              ."<br />\n"
              ."<br />\n\n\n"
              ."<div align=\"center\">\n"
              ."<table class='container7' cellpadding=\"6\" cellspacing=\"1\" border=\"0\" width=\"70%\" bgcolor=\"#E1E1E1\">"
              ."<tr>"
	      ."<td bordercolor=\"#808080\">Loading..</td>"
              ."</tr> "
              ."<tr> "
	      ."<td align=\"center\">"
	      ."<blockquote> "
              ."<p>&nbsp;</p>"
	      ."<p><h3>$msg</h3></p>"
              ."<p><a href=\"$url\"> "
	      ."CLICK_HERE_FOR_INSTANT_BROWSER_REDIRECT</a></p><br />"
              ."</blockquote>"
	      ."</div>\n"
	      ."</td>\n"
              ."</tr>\n"
              ."</table>\n\n\n"
              ."</body>\n"
              ."</html>";
}
?>
