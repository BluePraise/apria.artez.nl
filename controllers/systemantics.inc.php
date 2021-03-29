<?php

/*
  Systemantics Library of the Necessary Pieces
  Copyright (C) 2018 by Systemantics, Bureau for Informatics

  Systemantics GmbH
  Bleichstr. 11
  41747 Viersen
  GERMANY

  Web:    www.systemantics.net
  Email:  hello@systemantics.net

  Permission granted to use the files associated with this
  website only on your webserver.

  Changes to these files are PROHIBITED due to license restrictions.
*/



// require_once 'libs/parsedown/Parsedown.php';



function markdown($s) {
	return Parsedown::instance()->setBreaksEnabled(true)->text($s);
}

function markdownify($s) {
	return Parsedown::instance()->setBreaksEnabled(true)->line($s);
}

function curl_file_get_contents($URL) {
	$c = curl_init();
	curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($c, CURLOPT_URL, str_replace(' ', '%20', $URL));
	curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
	$contents = curl_exec($c);
	curl_close($c);
	if ($contents) return $contents;
	else return FALSE;
}

function error($code) {
	global $documentroot, $lang;

	header("Status: $code", true, $code);
	echo curl_file_get_contents('http' . ($_SERVER['HTTPS'] == 'on' ? 's' : '') . '://' . $_SERVER['SERVER_NAME'] . $documentroot . $lang . "/errors/$code");
}

function encode_mailto($s) {
	return preg_replace_callback('#<a href="mailto:(.+?)">(.*?)</a>#', function ($matches) {
		return '<a href="#" onclick="location.href=\'' . str_rot13('mailto:' . $matches[1]) . '\'.replace(/[a-zA-Z]/g,function(c){return String.fromCharCode((c<=\'Z\'?90:122)>=(c=c.charCodeAt(0)+13)?c:c-26);});return false">' . str_replace('@', '  [&#8203;at&#8203;]  ', $matches[2]) . '</a>';
	}, $s);
}

function isHTTPS() {
	return !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off';
}

function getFiletime($file){
	if (file_exists($file)) {
		return date("YmdHis", filemtime($file));
	}

	return false;
}
