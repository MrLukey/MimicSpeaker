<?php

namespace App\Factories\BuiltInClassFactories;

class DateTimeFactory
{
	public function __invoke(): \DateTime
	{
		$dateTime = new \DateTime();
		$timeZone = new \DateTimeZone('Europe/London');
		$dateTime->setTimezone($timeZone);
		$dateTime->format('d-m-Y H:i:s');
		return $dateTime;
	}
}