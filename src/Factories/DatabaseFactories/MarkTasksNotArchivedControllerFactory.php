<?php

namespace App\Factories\DatabaseFactories;
use App\Controllers\DatabaseControllers\MarkTasksNotArchivedController;
use Psr\Container\ContainerInterface;

class MarkTasksNotArchivedControllerFactory
{
	public function __invoke(ContainerInterface $container): MarkTasksNotArchivedController
	{
		return new MarkTasksNotArchivedController($container);
	}
}