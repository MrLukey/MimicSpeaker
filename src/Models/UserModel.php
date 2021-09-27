<?php

namespace App\Models;
use App\Entities\UserEntity;

class UserModel
{
	private \PDO $db;

	public function __construct(\PDO $db)
	{
		$this->db = $db;
	}

	public function insertNewUser(string $userName, string $hashPassword): ?array
	{
		$query = $this->db->prepare('INSERT INTO `users` (`name`, `password`)
											VALUES  (:userName, :hashPassword );');
		$query->bindParam(':name', $userName);
		$query->bindParam(':password', $hashPassword);
		$query->setFetchMode(\PDO::FETCH_CLASS, UserEntity::class);
		try {
			$query->execute();
			return null;
		} catch (\PDOException $exception) {
			return ['cause' => 'UserModel->insertNewUser()', 'exception' => $exception];
		}
	}

	public function authenticateUser(string $userName, string $hashPassword): ?array
	{
		$query = $this->db->prepare('SELECT EXISTS (
  												SELECT `name`, `lastActive`
  												FROM `users` 
  												WHERE userName = :userName 
  												  AND hashPassword = :hashPassword 
											);');
		$query->bindParam(':userName', $userName);
		$query->bindParam(':hashPassword', $hashPassword);
		try {
			$query->execute();
			return null;
		} catch (\PDOException $exception) {
			return ['cause' => 'UserModel->authenticateUser()', 'exception' => $exception];
		}
	}
}