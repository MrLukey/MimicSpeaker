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

	public function getProcessedTextByShortTitle(string $shortTitle): ?array
	{
		$sqlQuery =
			'SELECT `id`, `full_title`, `short_title`, `author`, `genre`, `year_first_published`, `file_path` 
			FROM `processed_texts` 
			WHERE  `short_title` = :short_title;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':short_title', $shortTitle);
		try {
			$query->execute();
			return $query->fetchAll();
		} catch (\PDOException $exception){
			$this->errorLogger->logDatabaseError('MimicSpeakerModel->getTextByShortTitle()', $exception);
			return null;
		}
	}

	public function getRandomProcessedTextByGenre(string $genre): ?array
	{
		$sqlQuery =
			'SELECT `id`, `full_title`, `short_title`, `author`, `genre`, `year_first_published`, `file_path` 
			FROM `processed_texts`
			WHERE `genre` = :genre
			ORDER BY RAND() 
			LIMIT 1;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':genre', $genre);
		try {
			$query->execute();
			return $query->fetchAll();
		} catch (\PDOException $exception){
			$this->errorLogger->logDatabaseError('MimicSpeakerModel->getRandomProcessedTextByGenre()', $exception);
			return null;
		}
	}

	public function getRandomProcessedText(): ?array
	{
		$sqlQuery =
			'SELECT `id`, `full_title`, `short_title`, `author`, `genre`, `year_first_published`, `file_path` 
			FROM `processed_texts` 
			ORDER BY RAND() 
			LIMIT 1;';
		$query = $this->db->prepare($sqlQuery);
		try {
			$query->execute();
			return $query->fetchAll();
		} catch (\PDOException $exception){
			$this->errorLogger->logDatabaseError('MimicSpeakerModel->getRandomProcessedText()', $exception);
			return null;
		}
	}

	public function getAllProcessedTexts(): ?array
	{
		$sqlQuery =
			'SELECT `id`, `full_title`, `short_title`, `author`, `genre`, `year_first_published`, `file_path`
			FROM `processed_texts`;';
		$query = $this->db->prepare($sqlQuery);
		try {
			$query->execute();
			return $query->fetchAll();
		} catch (\PDOException $exception){
			$this->errorLogger->logDatabaseError('MimicSpeakerModel->getAllProcessedTexts()', $exception);
			return null;
		}
	}

	public function getMimics(): ?array
	{
		$sqlQuery =
			'SELECT `id`, `user_id`, `word_array_json`
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

	public function insertMimic(int $userID, int $processedTextID, string $mimicString): bool
	{
		$sqlQuery =
			'INSERT INTO `mimics` (`user_id`, `processed_text_id`, `mimic_string`) 
			VALUES (:user_id, :processed_text_id, :mimic_string);';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':user_id', $userID);
		$query->bindParam(':processed_text_id', $processedTextID);
		$query->bindParam(':mimic_string', $mimicString);
		try {
			$query->execute();
			return true;
		} catch (\PDOException $exception) {
			$this->errorLogger->logDatabaseError('MimicSpeakerModel->insertMimic()', $exception);
			return false;
		}
	}
}