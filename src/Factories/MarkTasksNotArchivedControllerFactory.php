<?php

namespace App\Factories;
use App\Controllers\MarkTasksNotArchivedController;
use Psr\Container\ContainerInterface;

class MarkTasksNotArchivedControllerFactory
{
	public function __invoke(ContainerInterface $container): MarkTasksNotArchivedController
	{
		return new MarkTasksNotArchivedController($container);
	}
}