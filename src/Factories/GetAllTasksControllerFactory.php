<?php

namespace App\Factories;
use App\Controllers\GetAllTasksController;
use Psr\Container\ContainerInterface;

class GetAllTasksControllerFactory
{
	public function __invoke(ContainerInterface $container): GetAllTasksController
	{
		return new GetAllTasksController($container);
	}
}