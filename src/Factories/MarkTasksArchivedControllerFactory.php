<?php

namespace App\Factories;
use Psr\Container\ContainerInterface;
use App\Controllers\MarkTasksArchivedController;

class MarkTasksArchivedControllerFactory
{
	public function __invoke(ContainerInterface $container): MarkTasksArchivedController
	{
		return new MarkTasksArchivedController($container);
	}
}