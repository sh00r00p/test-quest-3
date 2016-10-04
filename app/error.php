<?php

class Error
{
	public function getReport()
	{
		require_once 'config.conf';

		switch($error_reporting){
			case 'develop':
				ini_set('error_reporting', E_ALL);
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				break;
			case 'none':
				ini_set('error_reporting', 0);
				ini_set('display_errors', 0);
				ini_set('display_startup_errors', 0);
				break;
			default:
				error_reporting(E_ERROR | E_WARNING | E_PARSE);
				ini_set('display_errors', 1);
				break;
		}

		return $error_reporting;
	}

	public function setError($message)
	{
		require 'config.conf';

		$date = date('d.m.Y h:i:s');
		if (file_exists($error_path)){
			error_log($date . ' ' . $message . "\n", 3, $error_path);
		} else {
			$fh = fopen($error_path, 'w');
			error_log($date . ' ' . $message . "\n", 3, $error_path);
			fclose($fh);
		}
	}
}