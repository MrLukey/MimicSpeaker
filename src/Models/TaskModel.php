<?php

namespace App\Models;
use App\Entities\TaskEntity;

class TaskModel
{
	private ActivityLoggerModel $activityLogger;
	private ErrorLoggerModel $errorLogger;
	private \PDO $db;

	public function __construct(\PDO $db, ActivityLoggerModel $activityLogger, ErrorLoggerModel $errorLogger)
	{
		$this->db = $db;
		$this->activityLogger = $activityLogger;
		$this->errorLogger = $errorLogger;
	}

	public function getAllTasksForUser(int $userID): ?array
	{
		$sqlQuery =
			'SELECT `id`, `userID`, `title`, `text`, `creationTime`, `complete`, `completionTime`, `archived`, `archivedTime` 
			FROM  `tasks` 
			WHERE `userID` = :userID
			ORDER BY complete, archived;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':userID', $userID);
		$query->setFetchMode(\PDO::FETCH_CLASS, TaskEntity::class);
		try {
			$query->execute();
			return $query->fetchAll();
		} catch (\PDOException $exception) {
			$this->errorLogger->logDatabaseError('TaskModel->getAllTasksForUser()', $exception);
			return null;
		}
	}

	public function insertTask(int $userID, string $title, string $text): bool
	{
		$sqlQuery =
			'INSERT INTO `tasks` (`userID`, `title`, `text`, `creationTime`) 
			VALUES (:userID, :title, :text, CURRENT_TIMESTAMP);';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':userID', $userID);
		$query->bindParam(':title', $title);
		$query->bindParam(':text', $text);
		try {
			$query->execute();
			$this->activityLogger->logTaskCreated($userID);
			return true;
		} catch (\PDOException $exception) {
			$this->errorLogger->logDatabaseError('TaskModel->insertTask()', $exception);
			return false;
		}
	}

	public function markTaskComplete(int $taskID, int $userID): bool
	{
		$sqlQuery =
			'UPDATE tasks 
			SET complete = 1, completionTime = CURRENT_TIMESTAMP 
			WHERE `id` = :taskID
			AND `userID` = :userID;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':taskID', $taskID);
		$query->bindParam(':userID', $userID);
		try {
			$query->execute();
			$this->activityLogger->logTaskCompleted($userID);
			return true;
		} catch (\PDOException $exception) {
			$this->errorLogger->logDatabaseError('TaskModel->markTaskComplete()', $exception);
			return false;
		}
	}

	public function markTaskIncomplete(int $taskID, int $userID): bool
	{
		$sqlQuery =
			"UPDATE tasks 
			SET complete = 0, completionTime = 'N/A' 
			WHERE `id` = :taskID
			AND `userID` = :userID;";
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':taskID', $taskID);
		$query->bindParam(':userID', $userID);
		try {
			$query->execute();
			$this->activityLogger->logTaskReset($userID);
			return true;
		} catch (\PDOException $exception) {
			$this->errorLogger->logDatabaseError('TaskModel->markTaskIncomplete()', $exception);
			return false;
		}
	}

	public function markTaskArchived(int $taskID, int $userID): bool
	{
		$sqlQuery =
			'UPDATE tasks 
			SET archived = 1, archivedTime = CURRENT_TIMESTAMP 
			WHERE `id` = :taskID
			AND `userID` = :userID;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':taskID', $taskID);
		$query->bindParam(':userID', $userID);
		try {
			$query->execute();
			$this->activityLogger->logTaskArchived($userID);
			return true;
		} catch (\PDOException $exception) {
			$this->errorLogger->logDatabaseError('TaskModel->markTaskArchived()', $exception);
			return false;
		}
	}

	public function markTaskNotArchived(int $taskID, int $userID): bool
	{
		$sqlQuery =
			"UPDATE tasks 
			SET archived = 0, archivedTime = 'N/A' 
			WHERE `id` = :taskID
			AND `userID` = :userID;";
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':taskID', $taskID);
		$query->bindParam(':userID', $userID);
		try {
			$query->execute();
			$this->activityLogger->logTaskRecovered($userID);
			return true;
		} catch (\PDOException $exception) {
			$this->errorLogger->logDatabaseError('TaskModel->markTaskNotArchived()', $exception);
			return false;
		}
	}

	public function deleteTaskPermanently(int $taskID, $userID): bool
	{
		$sqlQuery =
			'DELETE FROM `tasks` 
			WHERE `id` = :taskID
			AND `userID` = :userID;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':taskID', $taskID);
		$query->bindParam(':userID', $userID);
		try {
			$query->execute();
			$this->activityLogger->logTaskDeleted($userID);
			return true;
		} catch (\PDOException $exception) {
			$this->errorLogger->logDatabaseError('TaskModel->deleteTaskPermanently()', $exception);
			return false;
		}
	}
}