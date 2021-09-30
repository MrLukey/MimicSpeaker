<?php

namespace App\Models;
use App\Entities\TaskEntity;

class TaskModel
{
	private \PDO $db;

	public function __construct(\PDO $db)
	{
		$this->db = $db;
	}

	public function getAllTasksForUser(int $userID): array
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
			return ['cause' => 'TaskModel->getAllTasksForUser()', 'exception' => $exception];
		}
	}

	public function insertTask(int $userID, string $title, string $text): ?array
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
			return null;
		} catch (\PDOException $exception) {
			return ['cause' => 'TaskModel->insertTask()', 'exception' => $exception];
		}
	}

	public function markTaskComplete(int $taskID): ?array
	{
		$sqlQuery =
			'UPDATE tasks 
			SET complete = 1, completionTime = CURRENT_TIMESTAMP 
			WHERE `id` = :taskID;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':taskID', $taskID);
		try {
			$query->execute();
			return null;
		} catch (\PDOException $exception) {
			return ['cause' => 'TaskModel->markTaskComplete()', 'exception' => $exception];
		}
	}

	public function markTaskIncomplete(int $taskID): ?array
	{
		$sqlQuery =
			"UPDATE tasks 
			SET complete = 0, completionTime = 'N/A' 
			WHERE `id` = :taskID;";
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':taskID', $taskID);
		try {
			$query->execute();
			return null;
		} catch (\PDOException $exception) {
			return ['cause' => 'TaskModel->markTaskIncomplete()', 'exception' => $exception];
		}
	}

	public function markTaskArchived(int $taskID): ?array
	{
		$sqlQuery =
			'UPDATE tasks 
			SET archived = 1, archivedTime = CURRENT_TIMESTAMP 
			WHERE `id` = :taskID;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':taskID', $taskID);
		try {
			$query->execute();
			return null;
		} catch (\PDOException $exception) {
			return ['cause' => 'TaskModel->markTaskArchived()', 'exception' => $exception];
		}
	}

	public function markTaskNotArchived(int $taskID): ?array
	{
		$sqlQuery =
			"UPDATE tasks 
			SET archived = 0, archivedTime = 'N/A' 
			WHERE `id` = :taskID;";
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':taskID', $taskID);
		try {
			$query->execute();
			return null;
		} catch (\PDOException $exception) {
			return ['cause' => 'TaskModel->markTaskNotArchived()', 'exception' => $exception];
		}
	}

	public function deleteTaskPermanently(int $taskID): ?array
	{
		$sqlQuery =
			'DELETE FROM `tasks` 
			WHERE `id` = :taskID;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':taskID', $taskID);
		try {
			$query->execute();
			return null;
		} catch (\PDOException $exception) {
			return ['cause' => 'TaskModel->deleteTaskPermanently()', 'exception' => $exception];
		}
	}
}