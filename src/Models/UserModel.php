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

	public function insertNewUser(string $username, string $email, string $hashPassword): ?array
	{
		$sqlQuery =
			'INSERT INTO `users` (`username`, `email`, `password`)
			VALUES  (:username, :email, :password);';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':username', $username);
		$query->bindParam(':email', $email);
		$query->bindParam(':password', $hashPassword);
		try {
			$query->execute();
			return null;
		} catch (\PDOException $exception) {
			return ['cause' => 'UserModel->insertNewUser()', 'exception' => $exception];
		}
	}

	public function getUserByName(string $username): array
	{
		$sqlQuery =
			'SELECT `id`, `username`, `email`, 
       		FROM `users` 
			WHERE `username` = :username;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':username', $username);
		$query->setFetchMode(\PDO::FETCH_CLASS, UserEntity::class);
		try {
			$query->execute();
			return $query->fetchAll();
		} catch (\PDOException $exception) {
			return ['cause' => 'UserModel->getUserByName()', 'exception' => $exception];
		}
	}

	public function getHashedPasswordForUser(string $username): ?array
	{
		$sqlQuery =
			'SELECT `password`
  			FROM `users` 
  			WHERE username = :username;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':username', $username);
		try {
			$query->execute();
			return $query->fetchAll();
		} catch (\PDOException $exception) {
			return ['cause' => 'UserModel->getHashedPasswordForUser()', 'exception' => $exception];
		}
	}
}