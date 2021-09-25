<?php

namespace App\Factories;
use App\Controllers\MarkTasksIncompleteController;
use Psr\Container\ContainerInterface;

class MarkTasksIncompleteControllerFactory
{
	public function __invoke(ContainerInterface $container): MarkTasksIncompleteController
	{
		return new MarkTasksIncompleteController($container);
	}
}