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
			SET `login_attempts` = `login_attempts` + 1 
			WHERE `user_id` = :user_id;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':user_id', $userID);
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
			WHERE `user_id` = :user_id;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':user_id', $userID);
		try {
			$query->execute();
			return true;
		} catch (\PDOException $exception){
			$this->errorLogger->logDatabaseError('ActivityLoggerModel->logSuccessfulLogin()', $exception);
			return false;
		}
	}

	public function logMimicGenerated(int $userID): bool
	{
		$sqlQuery =
			'UPDATE `activity` 
			SET `mimics_generated` = `mimics_generated` + 1 
			WHERE `user_id` = :user_id;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':user_id', $userID);
		try {
			$query->execute();
			return true;
		} catch (\PDOException $exception){
			$this->errorLogger->logDatabaseError('ActivityLoggerModel->logTaskCreated()', $exception);
			return false;
		}
	}

	public function logMimicPublished(int $userID): bool
	{
		$sqlQuery =
			'UPDATE `activity` 
			SET `mimics_published` = `mimics_published` + 1 
			WHERE `user_id` = :user_id;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':user_id', $userID);
		try {
			$query->execute();
			return true;
		} catch (\PDOException $exception){
			$this->errorLogger->logDatabaseError('ActivityLoggerModel->logTaskCompleted()', $exception);
			return false;
		}
	}

	public function logMimicDeleted(int $userID): bool
	{
		$sqlQuery =
			'UPDATE `activity` 
			SET `mimics_deleted` = `mimics_deleted` + 1 
			WHERE `user_id` = :user_id;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':user_id', $userID);
		try {
			$query->execute();
			return true;
		} catch (\PDOException $exception){
			$this->errorLogger->logDatabaseError('ActivityLoggerModel->logTaskReset()', $exception);
			return false;
		}
	}

	public function logMimicRecovered(int $userID): bool
	{
		$sqlQuery =
			'UPDATE `activity` 
			SET `mimics_recovered` = `mimics_recovered` + 1 
			WHERE `user_id` = :user_id;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':user_id', $userID);
		try {
			$query->execute();
			return true;
		} catch (\PDOException $exception){
			$this->errorLogger->logDatabaseError('ActivityLoggerModel->logTaskArchived()', $exception);
			return false;
		}
	}
}