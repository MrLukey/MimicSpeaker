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
		$query = $this->db->prepare('SELECT `id`, `text`, `createdAt`, `complete`, `completedAt`, `deleted`, `deletedAt` FROM  `tasks`');
		$query->setFetchMode(\PDO::FETCH_CLASS, TaskEntity::class);
		try {
			$query->execute();
			return $query->fetchAll();
		} catch (\PDOException $exception) {
			return ['cause' => 'TaskModel->getAllTasks()', 'exception' => $exception];
		}
	}

	public function insertTask(string $text): ?array
	{
		$query = $this->db->prepare('INSERT INTO `tasks` (`text`) VALUES (:text);');
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
		$query = $this->db->prepare('UPDATE tasks SET complete = 1, completedAt = CURRENT_TIMESTAMP WHERE `id` = :taskID;');
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
		$query = $this->db->prepare("UPDATE tasks SET complete = 0, completedAt = 'N/A' WHERE `id` = :taskID;");
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
		$query = $this->db->prepare('UPDATE tasks SET deleted = 1, deletedAt = CURRENT_TIMESTAMP WHERE `id` = :taskID;');
		$query->bindParam(':taskID', $taskID);
		try {
			$query->execute();
			return null;
		} catch (\PDOException $exception) {
			return ['cause' => 'TaskModel->markTaskDeleted()', 'exception' => $exception];
		}
	}

	public function recoverDeletedTask(int $taskID): ?array
	{
		$query = $this->db->prepare('UPDATE tasks SET deleted = 0 WHERE `id` = :taskID;');
		$query->bindParam(':taskID', $taskID);
		try {
			$query->execute();
			return null;
		} catch (\PDOException $exception) {
			return ['cause' => 'TaskModel->recoverDeletedTask()', 'exception' => $exception];
		}
	}
}