<?php

namespace App\Factories;
use App\Controllers\EditTasksController;
use Psr\Container\ContainerInterface;

class EditTasksControllerFactory
{
	public function __invoke(ContainerInterface $container): EditTasksController
	{
		return new EditTasksController($container);
	}
}