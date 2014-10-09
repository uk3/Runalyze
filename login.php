<?php
/**
 * RUNALYZE
 * 
 * @author Hannes Christiansen
 * @copyright http://www.runalyze.de/
 */
if (!file_exists('config.php')) {
	include 'install.php';
	exit();
}

require 'inc/class.Frontend.php';
$Frontend = new Frontend(true);

if (isset($_GET['delete'])) 
    SessionAccountHandler::logout();

if (isset($_GET['out']))
	SessionAccountHandler::logout();

if (SessionAccountHandler::isLoggedIn())
	header('Location: index.php');

include 'inc/tpl/header.php';

if (USER_CANT_LOGIN) {
	include FRONTEND_PATH.'tpl/login.maintenance.php';
} else {
	include FRONTEND_PATH.'tpl/login.php';
}

include 'inc/tpl/footer.php';