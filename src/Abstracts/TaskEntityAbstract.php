<?php

namespace App\Abstracts;

abstract class TaskEntityAbstract
{
	protected int $id;
	protected string $text;
	protected bool $complete;
	protected bool $deleted;
	protected string $createdAt;
	protected string $completedAt;
	protected string $deletedAt;

	public function getID(): int
	{
		return $this->id;
	}

	public function getText(): string
	{
		return $this->text;
	}

	public function getCreatedAt(): string
	{
		return $this->createdAt;
	}

	public function getCompletedAt(): string
	{
		return $this->completedAt;
	}

	public function getDeletedAt(): string
	{
		return $this->deletedAt;
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