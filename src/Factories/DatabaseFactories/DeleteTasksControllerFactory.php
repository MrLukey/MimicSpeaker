<?php

namespace App\Factories\DatabaseFactories;
use App\Controllers\DatabaseControllers\deleteTasksController;
use Psr\Container\ContainerInterface;

class deleteTasksControllerFactory
{
	public function __invoke(ContainerInterface $container): deleteTasksController
	{
		return new deleteTasksController($container);
	}
}