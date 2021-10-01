<?php
namespace App\Factories\ModelFactories;
use App\Models\ErrorLoggerModel;
use Psr\Container\ContainerInterface;

class ErrorLoggerModelFactory
{
	public function __invoke(ContainerInterface $container): ErrorLoggerModel
	{
		$dateTime = $container->get('dateTime');
		return new ErrorLoggerModel($dateTime);
	}
}