<?php

namespace App\Factories\DatabaseFactories;
use App\Controllers\DatabaseControllers\MarkTasksIncompleteController;
use Psr\Container\ContainerInterface;

class MarkTasksIncompleteControllerFactory
{
	public function __invoke(ContainerInterface $container): MarkTasksIncompleteController
	{
		return new MarkTasksIncompleteController($container);
	}
}