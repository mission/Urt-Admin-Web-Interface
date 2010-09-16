<?php
$do = $_GET['do'];
$out = explode("_", $do);
include("doaction.php");
if ($out[0] == "slap1") {
	$d = new doaction();
	$d->slap1($out[1], $out[2]);
} elseif ($out[0] == "kick") {
	$d = new doaction();
	$d->kick($out[1], $out[2]);
} elseif ($out[0] == "ban") {
	$d = new doaction();
	$d->ban($out[1]);
}
?>