<?php

namespace App\Models;

class ErrorLoggerModel
{
	private string $databaseErrorLogs = '../logs/errors/database.txt';
	private string $testingLogs = '../logs/testing/testing.txt';
	private \DateTime $dateTime;

	public function __construct(\DateTime $dateTime)
	{
		$this->dateTime = $dateTime;
		if (!is_dir('../logs/errors'))
			mkdir('../logs/errors');
		if (!is_dir('../logs/testing'))
			mkdir('../logs/testing');
		if (!file_exists($this->databaseErrorLogs))
			file_put_contents($this->databaseErrorLogs, "SlimToDo App Database Error Logs\n");
		if (!file_exists($this->testingLogs))
			file_put_contents($this->testingLogs, "SlimToDo App Testing Logs\n");
	}

	public function logDatabaseError(string $cause, \PDOException $exception)
	{
		$errorString = 'DB-' . $this->dateTime->getTimestamp() . ' in ' . $cause . ' at line ' . $exception->getLine() . ' - ' . $exception->getMessage() . "\n";
		file_put_contents($this->databaseErrorLogs, $errorString, FILE_APPEND | LOCK_EX);
	}

	public function logString(string $cause)
	{
		file_put_contents($this->testingLogs, $cause, FILE_APPEND | LOCK_EX);
	}

	public function logJsonData(array $data)
	{
		file_put_contents($this->testingLogs, json_encode($data), FILE_APPEND | LOCK_EX);
	}
}