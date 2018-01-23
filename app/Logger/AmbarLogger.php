<?php

namespace App\Logger;

use \Monolog\Logger;
use \Monolog\Handler\StreamHandler;

class AmbarLogger
{
	private static $_logger;

	public static function log($message, $data = [])
	{
		if (!AmbarLogger::$_logger)
		{
			AmbarLogger::$_logger = new Logger('App');
        	$streamHandler = new StreamHandler(storage_path('logs/app.log'));
        	AmbarLogger::$_logger->pushHandler($streamHandler, Logger::INFO);
		}

		AmbarLogger::$_logger->info($message, $data);
	}
}