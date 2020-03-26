<?php
defined('BASEPATH') OR exit('No direct script access allowed');


	
$active_group = 'default';
$query_builder = TRUE;
$root = $_SERVER['HTTP_HOST'];
switch ($root) {
	case 'pabili.store':
		$db_host = '43.255.154.8';
		$db_username =  'pabili_user';
		$db_password = 'akinaherravillanueva';
		$db_database = 'pabili';
		break;
	default:
		$db_host = "localhost";
		$db_username = "root";
		$db_password = "";
		$db_database = "pabili";
		break;
}
		

		$active_group = "default";
		$query_builder = TRUE;
		$db["default"] = array(
			"dsn"	=> "",
			"hostname" => $db_host,
			"username" => $db_username,
			"password" => $db_password,
			"database" => $db_database,
			"dbdriver" => "mysqli",
			"dbprefix" => "",
			"pconnect" => FALSE,
			"db_debug" => (ENVIRONMENT !== "production"),
			"cache_on" => FALSE,
			"cachedir" => "",
			"char_set" => "utf8",
			"dbcollat" => "utf8_general_ci",
			"swap_pre" => "",
			"encrypt" => FALSE,
			"compress" => FALSE,
			"stricton" => FALSE,
			"failover" => array(),
			"save_queries" => TRUE
		);

