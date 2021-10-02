<?php

namespace App\Models;
use App\Abstracts\UserEntityAbstract;
use App\Entities\UserEntity;

class UserModel
{
	private \PDO $db;
	private ErrorLoggerModel $errorLogger;

	public function __construct(\PDO $db, ErrorLoggerModel $errorLogger)
	{
		$this->db = $db;
		$this->errorLogger = $errorLogger;
	}

	public function insertNewUser(string $username, string $email, string $hashPassword): bool
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
			return true;
		} catch (\PDOException $exception) {
			$this->errorLogger->logDatabaseError('UserModel->insertNewUser()', $exception);
			return false;
		}
	}

	public function linkActivityTableToUser(int $userID): bool
	{
		$sqlQuery =
			'INSERT INTO `activity` (`userID`) 
			VALUES (:userID);';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':userID', $userID);
		try {
			$query->execute();
			return true;
		} catch (\PDOException $exception) {
			$this->errorLogger->logDatabaseError('UserModel->linkActivityTableToUser()', $exception);
			return false;
		}
	}

	public function getUserByName(string $username): ?UserEntityAbstract
	{
		$sqlQuery =
			'SELECT `id`, `username`, `email`
       		FROM `users` 
			WHERE `username` = :username;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':username', $username);
		$query->setFetchMode(\PDO::FETCH_CLASS, UserEntity::class);
		try {
			$query->execute();
			return $query->fetchAll()[0];
		} catch (\PDOException $exception) {
			$this->errorLogger->logDatabaseError('UserModel->getUserByName()', $exception);
			return null;
		}
	}

	public function getHashedPasswordForUser(int $userID): ?string
	{
		$sqlQuery =
			'SELECT `password`
  			FROM `users` WHERE `id` = :userID;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':userID', $userID);
		try {
			$query->execute();
			return $query->fetchAll()[0]['password'];
		} catch (\PDOException $exception) {
			$this->errorLogger->logDatabaseError('UserModel->getHashedPasswordForUser()', $exception);
			return null;
		}
	}
}