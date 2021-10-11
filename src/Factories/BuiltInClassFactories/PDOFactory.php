<?php

namespace App\Factories\BuiltInClassFactories;

class PDOFactory
{
	public function __invoke(): \PDO
	{
		$db = new \PDO('mysql:host=127.0.0.1; dbname=mimic_speaker_database', 'root', 'password');
		$db->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
		$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		return $db;
	}
}