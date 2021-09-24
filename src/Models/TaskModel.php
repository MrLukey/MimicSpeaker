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
		return $this->db->query('SELECT `id`, `text`, `createdAt`, `completedAt` FROM `tasks` WHERE `complete` = 1;')->fetchAll();
	}

	public function getIncompleteTasks(): array
	{
		return $this->db->query('SELECT `id`, `text`, `createdAt` FROM `tasks` WHERE `complete` = 0;')->fetchAll();
	}

	public function insertNewTask(string $text)
	{
		$query = $this->db->prepare('INSERT INTO `tasks` (`text`) VALUES (:text);');
		$query->bindParam(':text', $text);
		$query->execute();
	}

	public function markTaskComplete(int $taskID)
	{
		$this->db->query('UPDATE tasks SET complete = 1 WHERE `id` = '. $taskID. ';');
	}
}