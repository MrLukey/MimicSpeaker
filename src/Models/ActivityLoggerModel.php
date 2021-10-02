<?php

namespace App\Models;

class ActivityLoggerModel
{
	private \PDO $db;
	private ErrorLoggerModel $errorLogger;

	public function __construct(\PDO $db, ErrorLoggerModel $errorLogger)
	{
		$this->db = $db;
		$this->errorLogger = $errorLogger;
	}

	public function logUnsuccessfullLogin(int $userID): bool
	{
		$sqlQuery =
			'UPDATE `activity` 
			SET `loginAttempts` = `loginAttempts` + 1 
			WHERE `userID` = :userID;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':userID', $userID);
		try {
			$query->execute();
			return true;
		} catch (\PDOException $exception){
			$this->errorLogger->logDatabaseError('ActivityLoggerModel->logUnsuccessfullLogin()', $exception);
			return false;
		}
	}

	public function logSuccessfulLogin(int $userID): bool
	{
		$sqlQuery =
			'UPDATE `activity` 
			SET `logins` = `logins` + 1 
			WHERE `userID` = :userID;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':userID', $userID);
		try {
			$query->execute();
			return true;
		} catch (\PDOException $exception){
			$this->errorLogger->logDatabaseError('ActivityLoggerModel->logSuccessfulLogin()', $exception);
			return false;
		}
	}

	public function logTaskCreated(int $userID): bool
	{
		$sqlQuery =
			'UPDATE `activity` 
			SET `tasksCreated` = `tasksCreated` + 1 
			WHERE `userID` = :userID;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':userID', $userID);
		try {
			$query->execute();
			return true;
		} catch (\PDOException $exception){
			$this->errorLogger->logDatabaseError('ActivityLoggerModel->logTaskCreated()', $exception);
			return false;
		}
	}

	public function logTaskCompleted(int $userID): bool
	{
		$sqlQuery =
			'UPDATE `activity` 
			SET `tasksCompleted` = `tasksCompleted` + 1 
			WHERE `userID` = :userID;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':userID', $userID);
		try {
			$query->execute();
			return true;
		} catch (\PDOException $exception){
			$this->errorLogger->logDatabaseError('ActivityLoggerModel->logTaskCompleted()', $exception);
			return false;
		}
	}

	public function logTaskReset(int $userID): bool
	{
		$sqlQuery =
			'UPDATE `activity` 
			SET `tasksReset` = `tasksReset` + 1 
			WHERE `userID` = :userID;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':userID', $userID);
		try {
			$query->execute();
			return true;
		} catch (\PDOException $exception){
			$this->errorLogger->logDatabaseError('ActivityLoggerModel->logTaskReset()', $exception);
			return false;
		}
	}

	public function logTaskArchived(int $userID): bool
	{
		$sqlQuery =
			'UPDATE `activity` 
			SET `tasksArchived` = `tasksArchived` + 1 
			WHERE `userID` = :userID;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':userID', $userID);
		try {
			$query->execute();
			return true;
		} catch (\PDOException $exception){
			$this->errorLogger->logDatabaseError('ActivityLoggerModel->logTaskArchived()', $exception);
			return false;
		}
	}

	public function logTaskRecovered(int $userID): bool
	{
		$sqlQuery =
			'UPDATE `activity` 
			SET `tasksRecovered` = `tasksRecovered` + 1 
			WHERE `userID` = :userID;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':userID', $userID);
		try {
			$query->execute();
			return true;
		} catch (\PDOException $exception){
			$this->errorLogger->logDatabaseError('ActivityLoggerModel->logTaskRecovered()', $exception);
			return false;
		}
	}

	public function logTaskDeleted(int $userID): bool
	{
		$sqlQuery =
			'UPDATE `activity` 
			SET `tasksDeleted` = `tasksDeleted` + 1 
			WHERE `userID` = :userID;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':userID', $userID);
		try {
			$query->execute();
			return true;
		} catch (\PDOException $exception){
			$this->errorLogger->logDatabaseError('ActivityLoggerModel->logTaskDeleted()', $exception);
			return false;
		}
	}
}