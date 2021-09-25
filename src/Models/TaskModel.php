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
		$query = $this->db->prepare('SELECT `id`, `txt`, `createdAt`, `completedAt` FROM `tass` WHERE `complete` = 1 AND `deleted` = 0;');
		try {
			$query->execute();
			return $query->fetchAll();
		} catch (\PDOException $exception){
			return ['cause' => 'TaskModel->getCompletedTasks()', 'exception' => $exception];
		}
	}

	public function getIncompleteTasks(): array
	{
		$query = $this->db->query('SELECT `id`, `text`, `createdAt` FROM `tasks` WHERE `complete` = 0 AND `deleted` = 0;');
		if ($query->execute()){
			return $query->fetchAll();
		} else {
			return ['error' => $this->db->errorCode(), 'cause' => 'TaskModel.php->getCompletedTasks()', 'errorInfo' => $this->db->errorInfo()];
		}
	}

	public function insertNewTask(string $text): array
	{
		$query = $this->db->prepare('INSERT INTO `tasks` (`text`) VALUES (:text);');
		$query->bindParam(':text', $text);
		if ($query->execute()){
			return [];
		} else {
			return ['error' => $this->db->errorCode(), 'errorInfo' => 'Unexpected error when inserting a new task'];
		}
	}

	public function markTaskComplete(int $taskID)
	{
		$this->db->query('UPDATE tasks SET complete = 1, completedAt = CURRENT_TIMESTAMP WHERE `id` = '. $taskID. ';');
	}

	public function markTaskDeleted(int $taskID){
		$this->db->query('UPDATE tasks SET deleted = 1, deletedAt = CURRENT_TIMESTAMP WHERE `id` = '. $taskID. ';');
	}
}