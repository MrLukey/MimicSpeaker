<?php

namespace App\Abstracts;

abstract class UserEntityAbstract
{
	protected int $id;
	protected string $userName;
	protected string $lastActive;

	public function getId(): int
	{
		return $this->id;
	}

	public function getUserName(): string
	{
		return $this->userName;
	}

	public function getLastActive(): string
	{
		return $this->lastActive;
	}
}