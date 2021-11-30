<?php
include('./includes/config.inc.php');

$keres = $oldalak['/'];
if (isset($_GET['oldal'])) {
	if (isset($oldalak[$_GET['oldal']]) && file_exists("./templates/{$oldalak[$_GET['oldal']]['fajl']}.tpl.php")) {
		$keres = $oldalak[$_GET['oldal']];
	}
	else if (isset($extrak[$_GET['oldal']]) && file_exists("./templates/{$extrak[$_GET['oldal']]['fajl']}.tpl.php")) {
		$keres = $extrak[$_GET['oldal']];
	}
	else { 
		$keres = $hiba_oldal;
		header("HTTP/1.0 404 Not Found");
	}
}

include('./index.tpl.php'); 
?>