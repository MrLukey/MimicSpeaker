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
		$query = $this->db->prepare("INSERT INTO `users` (`userName`, `hashPassword`)
											VALUES  (:userName, '$hashPassword');");
		$query->bindParam(':userName', $userName);
		try {
			$query->execute();
			return null;
		} catch (\PDOException $exception) {
			return ['cause' => 'UserModel->insertNewUser()', 'exception' => $exception];
		}
	}

	public function getUserByName(string $userName): array
	{
		$query = $this->db->prepare('SELECT `id`, `userName`, `lastActive` FROM `users` WHERE `userName` = :userName;');
		$query->bindParam(':userName', $userName);
		$query->setFetchMode(\PDO::FETCH_CLASS, UserEntity::class);
		try {
			$query->execute();
			return $query->fetchAll();
		} catch (\PDOException $exception) {
			return ['cause' => 'UserModel->getUserByName()', 'exception' => $exception];
		}
	}

	public function getHashedPasswordForUser(string $userName): ?array
	{
		$query = $this->db->prepare('SELECT `hashPassword`
  												FROM `users` 
  												WHERE userName = :userName;');
		$query->bindParam(':userName', $userName);
		try {
			$query->execute();
			return $query->fetchAll();
		} catch (\PDOException $exception) {
			return ['cause' => 'UserModel->getHashedPasswordForUser()', 'exception' => $exception];
		}
	}
}