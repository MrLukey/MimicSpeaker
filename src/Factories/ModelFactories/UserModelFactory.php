<?php

namespace App\Factories\ModelFactories;
use App\Models\UserModel;

class UserModelFactory
{
	public function __invoke(): UserModel
	{
		$db = new \PDO('mysql:host=127.0.0.1; dbname=SlimToDoApp', 'root', 'password');
		$db->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
		$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		return new UserModel($db);
	}
}