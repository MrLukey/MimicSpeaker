<?php

namespace App\Factories;
use App\Controllers\CompletedTasksController;
use Psr\Container\ContainerInterface;

class CompletedTasksControllerFactory
{
	public function __invoke(ContainerInterface $container): CompletedTasksController
	{
		return new CompletedTasksController($container);
	}
}