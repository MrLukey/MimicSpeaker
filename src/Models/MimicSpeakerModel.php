<?php

namespace App\Models;

class MimicSpeakerModel
{
	private \PDO $db;
	private ErrorLoggerModel $errorLogger;

	public function __construct(\PDO $db, ErrorLoggerModel $errorLogger)
	{
		$this->db = $db;
		$this->errorLogger = $errorLogger;
	}

	public function getMimics(): ?array
	{
		$sqlQuery =
			'SELECT `id`, `user_id`, `text_json`
			FROM  `mimics`;';
		$query = $this->db->prepare($sqlQuery);
		try {
			$query->execute();
			return $query->fetchAll();
		} catch (\PDOException $exception) {
			$this->errorLogger->logDatabaseError('MimicSpeakerModel->getMimics()', $exception);
			return null;
		}
	}

	public function insertMimic(int $userID, string $textJSON): bool
	{
		$sqlQuery =
			'INSERT INTO `mimics` (`user_id`, `text_json`) 
			VALUES (:user_id, :text_json);';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':user_id', $userID);
		$query->bindParam(':text_json', $textJSON);
		try {
			$query->execute();
			return true;
		} catch (\PDOException $exception) {
			$this->errorLogger->logDatabaseError('MimicSpeakerModel->insertMimic()', $exception);
			return false;
		}
	}
}