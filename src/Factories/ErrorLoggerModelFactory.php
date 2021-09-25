<?php
namespace App\Factories;
use App\Models\ErrorLoggerModel;

class ErrorLoggerModelFactory
{
	public function __invoke(): ErrorLoggerModel
	{
		$logfile = 'testFile.txt';
		return new ErrorLoggerModel($logfile);
	}
}