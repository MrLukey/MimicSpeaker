<?php

namespace App\Models;

class ErrorLoggerModel
{
	private string $databaseErrorLogs = '../logs/errors/database.txt';
	private string $suspiciousActivityLogs = '../logs/suspiciousActivity/loginAttempts.txt';
	private string $testingLogs = '../logs/testing/testing.txt';
	private \DateTime $dateTime;

	public function __construct(\DateTime $dateTime)
	{
		$this->dateTime = $dateTime;
		if (!is_dir('../logs/errors'))
			mkdir('../logs/errors');
		if (!is_dir('../logs/suspiciousActivity'))
			mkdir('../logs/suspiciousActivity');
		if (!is_dir('../logs/testing'))
			mkdir('../logs/testing');
		if (!file_exists($this->databaseErrorLogs))
			file_put_contents($this->databaseErrorLogs, "SlimToDo App Database Error Logs\n");
		if (!file_exists($this->testingLogs))
			file_put_contents($this->testingLogs, "SlimToDo App Testing Logs\n");
	}

	public function logDatabaseError(string $cause, \PDOException $exception)
	{
		$errorData = [
			'time' => $this->dateTime->getTimestamp(),
			'cause' => $cause,
			'code' => $exception->getCode(),
			'message' => $exception->getMessage(),
			'file' => $exception->getFile(),
			'line' => $exception->getLine(),
			'trace' => $exception->getTrace(),
			'previous' => $exception->getPrevious()
		];
		file_put_contents($this->databaseErrorLogs, json_encode($errorData), FILE_APPEND | LOCK_EX);
	}

	public function logSuspiciousActivity($data)
	{
		file_put_contents($this->suspiciousActivityLogs, json_encode($data) . "\n", FILE_APPEND | LOCK_EX);
	}

	public function logTestString(string $cause)
	{
		file_put_contents($this->testingLogs, $cause . "\n", FILE_APPEND | LOCK_EX);
	}

	public function logTestJSON($data)
	{
		file_put_contents($this->testingLogs, json_encode($data) . "\n", FILE_APPEND | LOCK_EX);
	}

	public function logVarDump($data)
	{
		file_put_contents($this->testingLogs, var_dump($data) . "\n", FILE_APPEND | LOCK_EX);
	}
}