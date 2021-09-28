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

	public function getHashedPassword(string $userName): ?array
	{
		$query = $this->db->prepare('SELECT `hashPassword`
  												FROM `users` 
  												WHERE userName = :userName;');
		$query->bindParam(':userName', $userName);
		try {
			$query->execute();
			return $query->fetch();
		} catch (\PDOException $exception) {
			return ['cause' => 'UserModel->getHashedPassword()', 'exception' => $exception];
		}
	}
}