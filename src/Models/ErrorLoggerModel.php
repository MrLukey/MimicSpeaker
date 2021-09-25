<?php

namespace App\Models;

class ErrorLoggerModel
{
	private string $logfile;
	private \DateTime $dateTime;

	public function __construct(string $logfile, \DateTime $dateTime)
	{
		$this->logfile = '../logs/ErrorLogs/' . $logfile;
		$this->dateTime = $dateTime;
		if (!file_exists($this->logfile)){
			file_put_contents($this->logfile, "ToDo App Error Logging\n");
		}
	}

	public function logDatabaseError(string $cause, \PDOException $exception)
	{
		$errorString = 'DB-' . $this->dateTime->getTimestamp() . ' in ' . $cause . ' at line ' . $exception->getLine() . ' - ' . $exception->getMessage() . "\n";
		file_put_contents($this->logfile, $errorString, FILE_APPEND | LOCK_EX);
	}
}