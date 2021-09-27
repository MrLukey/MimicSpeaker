<?php

namespace App\Factories\DatabaseFactories;
use App\Controllers\DatabaseControllers\MarkTasksCompleteController;
use Psr\Container\ContainerInterface;

class MarkTasksCompleteControllerFactory
{
	public function __invoke(ContainerInterface $container): MarkTasksCompleteController
	{
		return new MarkTasksCompleteController($container);
	}
}