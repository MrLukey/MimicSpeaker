<?php
namespace App\Factories;
use App\Models\ErrorLoggerModel;

class ErrorLoggerModelFactory
{
	public function __invoke(): ErrorLoggerModel
	{
		$logfile = 'errorLogs.txt';
		$dateTime = new \DateTime();
		return new ErrorLoggerModel($logfile, $dateTime);
	}
}