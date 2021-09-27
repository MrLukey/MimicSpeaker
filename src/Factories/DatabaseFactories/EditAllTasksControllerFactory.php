<?php

namespace App\Factories\DatabaseFactories;
use App\Controllers\DatabaseControllers\EditAllTasksController;
use Psr\Container\ContainerInterface;

class EditAllTasksControllerFactory
{
	public function __invoke(ContainerInterface $container): EditAllTasksController
	{
		return new EditAllTasksController($container);
	}
}