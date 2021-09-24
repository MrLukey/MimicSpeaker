<?php

namespace App\Factories;
use App\Controllers\IncompleteTasksController;
use Psr\Container\ContainerInterface;

class IncompleteTasksControllerFactory
{
	public function __invoke(ContainerInterface $container): IncompleteTasksController
	{
		return new IncompleteTasksController($container);
	}
}