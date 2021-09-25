<?php

namespace App\Factories;
use App\Controllers\AllTasksController;
use Psr\Container\ContainerInterface;

class AllTasksControllerFactory
{
	public function __invoke(ContainerInterface $container): AllTasksController
	{
		return new AllTasksController($container);
	}
}