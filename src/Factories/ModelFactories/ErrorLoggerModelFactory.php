<?php
namespace App\Factories\ModelFactories;
use App\Models\ErrorLoggerModel;

class ErrorLoggerModelFactory
{
	public function __invoke(): ErrorLoggerModel
	{
		$dateTime = new \DateTime();
		return new ErrorLoggerModel($dateTime);
	}
}