<?php

/*
	APRIA
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



error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);



if (!defined('WORDPRESS')) {
	define('WORDPRESS', FALSE);
}

if (WORDPRESS) {
	$sitename = get_bloginfo('name');
	// $documentroot = get_template_directory_uri() . '/';
}

$ACTIONS = array(
	'home' => array(
		'show',
	),
	'articles' => array(
		'show',
	),
	'pages' => array(
		'show',
	),
	'issue' => array(
		'show'
	),
	'tags' => array(
		'show',
	),
	'authors' => array(
		'show',
	),
	'search' => array(
		'results',
	),
	'newsletter' => array(
		'show',
	),
	'holding' => array(
		'show',
	),
	'opencall' => array(
		'show',
	),
	'news' => array(
		'show',
	),
);



ini_set('zlib.output_compression', 0);
ini_set('session.use_only_cookies', 0);

if (!isset($sitename)) {
	$sitename = 'APRIA';
}
session_set_cookie_params(0);
session_name(md5($sitename));
session_start();

$lang = 'en';
setlocale(LC_TIME, 'en_US');
date_default_timezone_set('Europe/Amsterdam');

if (!isset($documentroot)) {
	$documentroot = '/';
}
if (!isset($homeUrl)) {
	$homeUrl = $documentroot.'';
}

// Try to get content by id
$realm = $_GET['realm'];
$action = $_GET['action'];
$param = $_GET['param'];
$id = $_GET['id'];
if (!isset($ACTIONS[$realm])) {
	// No valid realm specified
	// Use first realm by default
	$realm = @reset(array_keys($ACTIONS));
}
if (!in_array($action, $ACTIONS[$realm])) {
	// No valid action specified
	// Shift URL parameters one step back
	$index = $id;
	$id = $param;
	$param = $action;
	// Use first action by default
	$action = reset($ACTIONS[$realm]);
}

// Set page title
$pageTitle = $sitename;

// Normal actions

header('Content-Type: text/html; charset=utf-8');

require_once 'libs/Smarty.class.php';
$smarty = new Smarty();

$smarty->debugging = false;
$smarty->caching = false;
$smarty->cache_lifetime = 120;

$smarty->setTemplateDir(__DIR__ . '/templates');
$smarty->setCompileDir(__DIR__ . '/cache/templates');
$smarty->setCacheDir(__DIR__ . '/cache');
$smarty->setConfigDir(__DIR__ . '/locales');

$smarty->configLoad("$lang.ini");

$template = $realm.'_'.$action;
$smarty->assign('content', "$template.tpl");

$filename = __DIR__ . "/controllers/$template.inc.php";
if (is_readable($filename)) {
	include $filename;
} else {
	echo "Cannot open controller '$filename'.";
	exit;
}

// Set URL info
$smarty->assign('lang', $lang);
$smarty->assign('realm', $realm);
$smarty->assign('action', $action);
$smarty->assign('param', $param);
$smarty->assign('id', $id);
$smarty->assign('pageTitle', $pageTitle);

$smarty->assign('documentroot', $documentroot);
$smarty->assign('homeUrl', $homeUrl);
$smarty->display("$template.tpl");
