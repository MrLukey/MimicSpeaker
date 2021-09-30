<?php

namespace App\Factories\DatabaseFactories;
use App\Controllers\DatabaseControllers\DeleteTasksController;
use Psr\Container\ContainerInterface;

class DeleteTasksControllerFactory
{
	public function __invoke(ContainerInterface $container): DeleteTasksController
	{
		return new DeleteTasksController($container);
	}
}