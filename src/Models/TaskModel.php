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

	public function getAllTasks(): array
	{
		$query = $this->db->prepare('SELECT `id`, `title`, `text`, `creationTime`, `complete`, `completionTime`, `deleted`, `deletionTime` FROM  `tasks` ORDER BY complete, deleted;');
		$query->setFetchMode(\PDO::FETCH_CLASS, TaskEntity::class);
		try {
			$query->execute();
			return $query->fetchAll();
		} catch (\PDOException $exception) {
			return ['cause' => 'TaskModel->getAllTasks()', 'exception' => $exception];
		}
	}

	public function insertTask(string $title, string $text): ?array
	{
		$query = $this->db->prepare('INSERT INTO `tasks` (`title`, `text`, `creationTime`) VALUES (:title, :text, CURRENT_TIMESTAMP);');
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
		$query = $this->db->prepare('UPDATE tasks SET complete = 1, completionTime = CURRENT_TIMESTAMP WHERE `id` = :taskID;');
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
		$query = $this->db->prepare("UPDATE tasks SET complete = 0, completionTime = 'N/A' WHERE `id` = :taskID;");
		$query->bindParam(':taskID', $taskID);
		try {
			$query->execute();
			return null;
		} catch (\PDOException $exception) {
			return ['cause' => 'TaskModel->markTaskIncomplete()', 'exception' => $exception];
		}
	}

	public function markTaskDeleted(int $taskID): ?array
	{
		$query = $this->db->prepare('UPDATE tasks SET deleted = 1, deletionTime = CURRENT_TIMESTAMP WHERE `id` = :taskID;');
		$query->bindParam(':taskID', $taskID);
		try {
			$query->execute();
			return null;
		} catch (\PDOException $exception) {
			return ['cause' => 'TaskModel->markTaskDeleted()', 'exception' => $exception];
		}
	}

	public function markTaskNotDeleted(int $taskID): ?array
	{
		$query = $this->db->prepare("UPDATE tasks SET deleted = 0, deletionTime = 'N/A' WHERE `id` = :taskID;");
		$query->bindParam(':taskID', $taskID);
		try {
			$query->execute();
			return null;
		} catch (\PDOException $exception) {
			return ['cause' => 'TaskModel->markTaskNotDeleted()', 'exception' => $exception];
		}
	}

	public function deleteTaskPermanently(int $taskID): ?array
	{
		$query = $this->db->prepare('DELETE FROM `tasks` WHERE `id` = :taskID;');
		$query->bindParam(':taskID', $taskID);
		try {
			$query->execute();
			return null;
		} catch (\PDOException $exception) {
			return ['cause' => 'TaskModel->deleteTaskPermanently()', 'exception' => $exception];
		}
	}
}