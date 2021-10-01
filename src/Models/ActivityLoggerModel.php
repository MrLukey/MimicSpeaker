<?php

namespace App\Models;

class ActivityLoggerModel
{
	private \PDO $db;

	public function __construct(\PDO $db)
	{
		$this->db = $db;
	}

	public function logLoginAttempt(int $userID): ?array
	{
		$sqlQuery =
			'UPDATE `activity` 
			SET `loginAttempts` = `loginAttempts` + 1 
			WHERE `userID` = :userID;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':userID', $userID);
		try {
			$query->execute();
			return null;
		} catch (\PDOException $exception){
			return ['cause' => 'ActivityLoggerModel->logLoginAttempt()', 'exception' => $exception];
		}
	}

	public function logSuccessfulLogin(int $userID): ?array
	{
		$sqlQuery =
			'UPDATE `activity` 
			SET `logins` = `logins` + 1 
			WHERE `userID` = :userID;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':userID', $userID);
		try {
			$query->execute();
			return null;
		} catch (\PDOException $exception){
			return ['cause' => 'ActivityLoggerModel->logSuccessfulLogin()', 'exception' => $exception];
		}
	}

	public function logTaskCreated(int $userID): ?array
	{
		$sqlQuery =
			'UPDATE `activity` 
			SET `tasksCreated` = `tasksCreated` + 1 
			WHERE `userID` = :userID;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':userID', $userID);
		try {
			$query->execute();
			return null;
		} catch (\PDOException $exception){
			return ['cause' => 'ActivityLoggerModel->logTaskCreated()', 'exception' => $exception];
		}
	}

	public function logTaskCompleted(int $userID): ?array
	{
		$sqlQuery =
			'UPDATE `activity` 
			SET `tasksCompleted` = `tasksCompleted` + 1 
			WHERE `userID` = :userID;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':userID', $userID);
		try {
			$query->execute();
			return null;
		} catch (\PDOException $exception){
			return ['cause' => 'ActivityLoggerModel->logTaskCompleted()', 'exception' => $exception];
		}
	}

	public function logTaskReset(int $userID): ?array
	{
		$sqlQuery =
			'UPDATE `activity` 
			SET `tasksReset` = `tasksReset` + 1 
			WHERE `userID` = :userID;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':userID', $userID);
		try {
			$query->execute();
			return null;
		} catch (\PDOException $exception){
			return ['cause' => 'ActivityLoggerModel->logTaskCompleted()', 'exception' => $exception];
		}
	}

	public function logTaskArchived(int $userID): ?array
	{
		$sqlQuery =
			'UPDATE `activity` 
			SET `tasksArchived` = `tasksArchived` + 1 
			WHERE `userID` = :userID;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':userID', $userID);
		try {
			$query->execute();
			return null;
		} catch (\PDOException $exception){
			return ['cause' => 'ActivityLoggerModel->logTaskArchived()', 'exception' => $exception];
		}
	}

	public function logTaskRecovered(int $userID): ?array
	{
		$sqlQuery =
			'UPDATE `activity` 
			SET `tasksRecovered` = `tasksRecovered` + 1 
			WHERE `userID` = :userID;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':userID', $userID);
		try {
			$query->execute();
			return null;
		} catch (\PDOException $exception){
			return ['cause' => 'ActivityLoggerModel->logTaskArchived()', 'exception' => $exception];
		}
	}

	public function logTaskDeleted(int $userID): ?array
	{
		$sqlQuery =
			'UPDATE `activity` 
			SET `tasksDeleted` = `tasksDeleted` + 1 
			WHERE `userID` = :userID;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':userID', $userID);
		try {
			$query->execute();
			return null;
		} catch (\PDOException $exception){
			return ['cause' => 'ActivityLoggerModel->logTaskDeleted()', 'exception' => $exception];
		}
	}
}