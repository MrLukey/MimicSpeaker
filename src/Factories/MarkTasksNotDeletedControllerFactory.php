<?php

namespace App\Factories;
use App\Controllers\MarkTasksNotDeletedController;
use Psr\Container\ContainerInterface;

class MarkTasksNotDeletedControllerFactory
{
	public function __invoke(ContainerInterface $container): MarkTasksNotDeletedController
	{
		return new MarkTasksNotDeletedController($container);
	}
}