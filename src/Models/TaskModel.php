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
}