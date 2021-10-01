<?php

namespace App\Models;

class ActivityLoggerModel
{
	private \PDO $db;

	public function __construct(\PDO $db)
	{
		$this->db = $db;
	}

	public function logLoginAttempt(string $username): ?array
	{
		$sqlQuery =
			'UPDATE `activity` 
			SET `loginAttempts` = `loginAttempts` + 1 
			WHERE `username` = :username;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':username', $username);
		try {
			$query->execute();
			return null;
		} catch (\PDOException $exception){
			return ['cause' => 'ActivityLoggerModel->logLoginAttempt()', 'exception' => $exception];
		}
	}

	public function logSuccessfulLogin(string $username): ?array
	{
		$sqlQuery =
			'UPDATE `activity` 
			SET `logins` = `logins` + 1 
			WHERE `username` = :username;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':username', $username);
		try {
			$query->execute();
			return null;
		} catch (\PDOException $exception){
			return ['cause' => 'ActivityLoggerModel->logSuccessfulLogin()', 'exception' => $exception];
		}
	}

	public function logTaskCreated(string $username): ?array
	{
		$sqlQuery =
			'UPDATE `activity` 
			SET `tasksCreated` = `tasksCreated` + 1 
			WHERE `username` = :username;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':username', $username);
		try {
			$query->execute();
			return null;
		} catch (\PDOException $exception){
			return ['cause' => 'ActivityLoggerModel->logTaskCreated()', 'exception' => $exception];
		}
	}

	public function logTaskCompleted(string $username): ?array
	{
		$sqlQuery =
			'UPDATE `activity` 
			SET `tasksCompleted` = `tasksCompleted` + 1 
			WHERE `username` = :username;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':username', $username);
		try {
			$query->execute();
			return null;
		} catch (\PDOException $exception){
			return ['cause' => 'ActivityLoggerModel->logTaskCompleted()', 'exception' => $exception];
		}
	}

	public function logTaskArchived(string $username): ?array
	{
		$sqlQuery =
			'UPDATE `activity` 
			SET `tasksArchived` = `tasksArchived` + 1 
			WHERE `username` = :username;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':username', $username);
		try {
			$query->execute();
			return null;
		} catch (\PDOException $exception){
			return ['cause' => 'ActivityLoggerModel->logTaskArchived()', 'exception' => $exception];
		}
	}

	public function logTaskDeleted(string $username): ?array
	{
		$sqlQuery =
			'UPDATE `activity` 
			SET `tasksDeleted` = `tasksDeleted` + 1 
			WHERE `username` = :username;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':username', $username);
		try {
			$query->execute();
			return null;
		} catch (\PDOException $exception){
			return ['cause' => 'ActivityLoggerModel->logTaskDeleted()', 'exception' => $exception];
		}
	}
}