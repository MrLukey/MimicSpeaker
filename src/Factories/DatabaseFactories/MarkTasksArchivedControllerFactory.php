<?php

namespace App\Factories\DatabaseFactories;
use Psr\Container\ContainerInterface;
use App\Controllers\DatabaseControllers\MarkTasksArchivedController;

class MarkTasksArchivedControllerFactory
{
	public function __invoke(ContainerInterface $container): MarkTasksArchivedController
	{
		return new MarkTasksArchivedController($container);
	}
}