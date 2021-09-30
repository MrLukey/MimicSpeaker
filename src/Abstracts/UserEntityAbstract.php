<?php

namespace App\Abstracts;

abstract class UserEntityAbstract
{
	protected int $id;
	protected string $username;
	protected string $lastActive;

	public function getId(): int
	{
		return $this->id;
	}

	public function getUserName(): string
	{
		return $this->username;
	}

	public function getLastActive(): string
	{
		return $this->lastActive;
	}
}