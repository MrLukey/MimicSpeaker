<?php

namespace App\Factories;
use App\Controllers\MarkTasksCompleteController;
use Psr\Container\ContainerInterface;

class MarkTasksCompleteControllerFactory
{
	public function __invoke(ContainerInterface $container): MarkTasksCompleteController
	{
		return new MarkTasksCompleteController($container);
	}
}