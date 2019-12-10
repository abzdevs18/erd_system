<?php
// error_reporting(0);
// loading from config folder
// loading from config folder
	if (file_exists(dirname(__FILE__).'/configs/config.php')) {
		require_once 'configs/config.php';
	}

//Loading the helpers
	require_once 'helpers/url_redirects.php';
	require_once 'helpers/session_helpers.php';
	
// Class file autoLoader
/**
* Autoloader Must:
* 1. Class name should match it's filename
*/

spl_autoload_register(function($className){
	require_once 'lib/' . $className . '.php';
});