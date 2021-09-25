<?php

namespace App\Factories;
use Psr\Container\ContainerInterface;
use App\Controllers\MarkTasksDeletedController;

class MarkTasksDeletedControllerFactory
{
	public function __invoke(ContainerInterface $container): MarkTasksDeletedController
	{
		return new MarkTasksDeletedController($container);
	}
}