<?php

namespace App\Models;

class TaskModel
{
	private \PDO $db;

	public function __construct(\PDO $db)
	{
		$this->db = $db;
	}

	public function getCompletedTasks(): array
	{
		$query = $this->db->prepare('SELECT `id`, `text`, `createdAt`, `completedAt` FROM `tasks` WHERE `complete` = 1 AND `deleted` = 0;');
		try {
			$query->execute();
			return $query->fetchAll();
		} catch (\PDOException $exception) {
			return ['cause' => 'TaskModel->getCompletedTasks()', 'exception' => $exception];
		}
	}

	public function getIncompleteTasks(): array
	{
		$query = $this->db->prepare('SELECT `id`, `text`, `createdAt` FROM `tasks` WHERE `complete` = 0 AND `deleted` = 0;');
		try {
			$query->execute();
			return $query->fetchAll();
		} catch (\PDOException $exception) {
			return ['cause' => 'TaskModel->getIncompleteTasks()', 'exception' => $exception];
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
			return ['cause' => 'TaskModel->insertNewTask()', 'exception' => $exception];
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

	public function markTaskDeleted(int $taskID): ?array
	{
		$query = $this->db->prepare('UPDATE tasks SET deleted = 1, deletedAt = CURRENT_TIMESTAMP WHERE `id` = :taskID');
		$query->bindParam(':taskID', $taskID);
		try {
			$query->execute();
			return null;
		} catch (\PDOException $exception) {
			return ['cause' => 'TaskModel->markTaskDeleted()', 'exception' => $exception];
		}
	}
}