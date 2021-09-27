<?php

namespace App\Factories;
use App\Controllers\EditAllTasksController;
use Psr\Container\ContainerInterface;

class EditAllTasksControllerFactory
{
	public function __invoke(ContainerInterface $container): EditAllTasksController
	{
		return new EditAllTasksController($container);
	}
}