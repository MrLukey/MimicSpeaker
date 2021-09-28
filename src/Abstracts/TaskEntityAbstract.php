<?php

namespace App\Abstracts;

abstract class TaskEntityAbstract
{
	protected int $id;
	protected int $userID;
	protected string $title;
	protected string $text;
	protected string $creationTime;
	protected bool $complete;
	protected string $completionTime;
	protected bool $archived;
	protected string $archivedTime;

	public function getID(): int
	{
		return $this->id;
	}

	public function getUserID(): int
	{
		return $this->userID;
	}

	public function getTitle(): string
	{
		return $this->title;
	}

	public function getText(): string
	{
		return $this->text;
	}

	public function getCreationTime(): string
	{
		return $this->creationTime;
	}

	public function isComplete(): bool
	{
		return $this->complete;
	}

	public function getCompletionTime(): string
	{
		return $this->completionTime;
	}

	public function isArchived(): bool
	{
		return $this->archived;
	}

	public function getArchivedTime(): string
	{
		return $this->archivedTime;
	}
}