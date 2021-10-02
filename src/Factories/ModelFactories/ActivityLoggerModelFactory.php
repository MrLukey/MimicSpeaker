<?php

namespace App\Factories\ModelFactories;
use App\Models\ActivityLoggerModel;
use Psr\Container\ContainerInterface;

class ActivityLoggerModelFactory
{
	public function __invoke(ContainerInterface $container): ActivityLoggerModel
	{
		$db = $container->get('pdo');
		$errorLogger = $container->get('errorLoggerModel');
		return new ActivityLoggerModel($db, $errorLogger);
	}
}