<?php

namespace App\Abstracts;

abstract class TaskEntityAbstract
{
	protected int $id;
	protected string $title;
	protected string $text;
	protected bool $complete;
	protected bool $deleted;
	protected string $creationTime;
	protected string $completionTime;
	protected string $deletionTime;

	public function getID(): int
	{
		return $this->id;
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

	public function getCompletionTime(): string
	{
		return $this->completionTime;
	}

	public function getDeletionTime(): string
	{
		return $this->deletionTime;
	}

	public function isComplete(): bool
	{
		return $this->complete;
	}

	public function isDeleted(): bool
	{
		return $this->deleted;
	}
}