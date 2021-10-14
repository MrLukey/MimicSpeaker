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

	public function insertProcessedText(array $textData): bool
	{
		$sqlQuery =
			'INSERT INTO `processed_texts` 
    			(`short_title`, `full_title`, `author`, `year_first_published`, `genre_id`, `file_path`)
            VALUES (:short_title, :full_title, :author, :year_first_published, :genre_id, :file_path);';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam('short_title', $textData['shortTitle']);
		$query->bindParam('full_title', $textData['fullTitle']);
		$query->bindParam('year_first_published', $textData['yearFirstPublished']);
		$query->bindParam('genre_id', $textData['genreID']);
		$query->bindParam('file_path', $textData['filePath']);
		try {
			$query->execute();
			return true;
		} catch (\PDOException $exception){
			$this->errorLogger->logDatabaseError('MimicSpeakerModel->insertProcessedText()', $exception);
			return false;
		}
	}

	public function getProcessedTextByShortTitle(string $shortTitle): ?array
	{
		$sqlQuery =
			'SELECT `processed_texts`.`id`, `processed_texts`.`full_title`, `processed_texts`.`short_title`,
       				`processed_texts`.`author`, `genres`.`name` AS `genre`, `processed_texts`.`year_first_published`,
       				`processed_texts`.`file_path`, `genres`.`image_path`
			FROM `processed_texts`
			INNER JOIN `genres` ON `processed_texts`.`genre_id`=`genres`.`id`
			WHERE  `short_title` = :short_title;';
		$query = $this->db->prepare($sqlQuery);
		$query->bindParam(':short_title', $shortTitle);
		try {
			$query->execute();
			return $query->fetchAll();
		} catch (\PDOException $exception){
			$this->errorLogger->logDatabaseError('MimicSpeakerModel->getProcessedTextByShortTitle()', $exception);
			return null;
		}
	}

	public function getRandomProcessedTextByGenre(string $genre): ?array
	{
		$sqlQuery =
			'SELECT `processed_texts`.`id`, `processed_texts`.`full_title`, `processed_texts`.`short_title`,
       				`processed_texts`.`author`, `genres`.`name` AS `genre`, `processed_texts`.`year_first_published`,
       				`processed_texts`.`file_path`, `genres`.`image_path`
			FROM `processed_texts`
			INNER JOIN `genres` ON `processed_texts`.`genre_id`=`genres`.`id`
			WHERE `genres`.`name` = :genre
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
			'SELECT `processed_texts`.`id`, `processed_texts`.`full_title`, `processed_texts`.`short_title`,
       				`processed_texts`.`author`, `genres`.`name` AS `genre`, `processed_texts`.`year_first_published`,
       				`processed_texts`.`file_path`, `genres`.`image_path`
			FROM `processed_texts`
			INNER JOIN `genres` ON `processed_texts`.`genre_id`=`genres`.`id` 
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
			'SELECT `processed_texts`.`id`, `processed_texts`.`full_title`, `processed_texts`.`short_title`,
       				`processed_texts`.`author`, `genres`.`name` AS `genre`, `processed_texts`.`year_first_published`,
       				`processed_texts`.`file_path`, `genres`.`image_path`
			FROM `processed_texts`
			INNER JOIN `genres` ON `processed_texts`.`genre_id`=`genres`.`id`';
		$query = $this->db->prepare($sqlQuery);
		try {
			$query->execute();
			return $query->fetchAll();
		} catch (\PDOException $exception){
			$this->errorLogger->logDatabaseError('MimicSpeakerModel->getAllProcessedTexts()', $exception);
			return null;
		}
	}

	public function getMimics(int $limit = 18): ?array
	{
		if ($limit > 1){
			$limitSQL = ' LIMIT ' . $limit;
		} else {
			$limitSQL = '';
		}
		$sqlQuery =
			'SELECT `users`.`username`, `mimics`.`mimic_string`, `mimics`.`created`, `mimics`.`likes`, 
       				`processed_texts`.`full_title`, `processed_texts`.`author`, `genres`.`name` AS `genre`, 
       				`genres`.`image_path`
			FROM  `mimics`
			INNER JOIN processed_texts ON `mimics`.`processed_text_id`=`processed_texts`.`id`
			INNER JOIN users ON `mimics`.`user_id`=`users`.`id`
			INNER JOIN genres ON `processed_texts`.`genre_id`=`genres`.`id`
			WHERE `deleted` = 0
			ORDER BY `likes`DESC, `created` DESC' . $limitSQL .';';
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