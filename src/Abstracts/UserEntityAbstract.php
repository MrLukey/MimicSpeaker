<?php

namespace App\Abstracts;

abstract class UserEntityAbstract
{
	protected int $id;
	protected string $name;
	protected string $lastActive;

	public function getId(): int
	{
		return $this->id;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getLastActive(): string
	{
		return $this->lastActive;
	}
}