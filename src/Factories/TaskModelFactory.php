<?php

namespace App\Factories;
use App\Models\TaskModel;

class TaskModelFactory
{
	public function __invoke(): TaskModel
	{
		$db = new \PDO('mysql:host=127.0.0.1; dbname=SlimToDoApp', 'root', 'password');
		$db->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
		$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		return new TaskModel($db);
	}
}