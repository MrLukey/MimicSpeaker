<?php

namespace App\Models;

class ErrorLoggerModel
{
	private string $logfile;

	public function __construct(string $logfile)
	{
		$this->logfile = '../logs/ErrorLogs/' . $logfile;
		if (!file_exists($this->logfile)){
			file_put_contents($this->logfile, "ToDo App Error Logging\n");
		}
	}

	public function logDatabaseError(string $cause, \PDOException $exception, \DateTime $errorTime)
	{
		$errorString = 'DB-' . $errorTime->getTimestamp() . ' in ' . $cause . ' at line ' . $exception->getLine() .
			' - ' . $exception->getMessage() . "\n";
		file_put_contents($this->logfile, $errorString, FILE_APPEND | LOCK_EX);
	}
}