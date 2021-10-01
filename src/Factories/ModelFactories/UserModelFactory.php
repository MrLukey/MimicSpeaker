<?php

namespace App\Factories\ModelFactories;
use App\Models\UserModel;
use Psr\Container\ContainerInterface;

class UserModelFactory
{
	public function __invoke(ContainerInterface $container): UserModel
	{
		$db = $container->get('pdo');
		$activityLogger = $container->get('activityLoggerModel');
		$errorLogger = $container->get('errorLoggerModel');
		return new UserModel($db, $activityLogger, $errorLogger);
	}
}