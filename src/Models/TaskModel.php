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
		try {
			$query = $this->db->query('SELECT `id`, `text`, `createdAt`, `completedAt` FROM `tasks` WHERE `complete` = 1 AND `deleted` = 0;');
		} catch (\Exception $exception){
			return [];
		}
		return $query->fetchAll();
	}

	public function getIncompleteTasks(): array
	{
		try {
			$query = $this->db->query('SELECT `id`, `text`, `createdAt` FROM `tasks` WHERE `complete` = 0 AND `deleted` = 0;');
		} catch (\Exception $exception){
			return [];
		}
		return $query->fetchAll();
	}

	public function insertNewTask(string $text)
	{
		$query = $this->db->prepare('INSERT INTO `tasks` (`text`) VALUES (:text);');
		$query->bindParam(':text', $text);
		$query->execute();
	}

	public function markTaskComplete(int $taskID)
	{
		$this->db->query('UPDATE tasks SET complete = 1, completedAt = CURRENT_TIMESTAMP WHERE `id` = '. $taskID. ';');
	}

	public function markTaskDeleted(int $taskID){
		$this->db->query('UPDATE tasks SET deleted = 1, deletedAt = CURRENT_TIMESTAMP WHERE `id` = '. $taskID. ';');
	}
}