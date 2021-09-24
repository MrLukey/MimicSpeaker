<?php

namespace App\Factories;
use App\Controllers\MarkTaskCompleteController;
use Psr\Container\ContainerInterface;

class MarkTaskCompleteControllerFactory
{
	public function __invoke(ContainerInterface $container): MarkTaskCompleteController
	{
		return new MarkTaskCompleteController($container);
	}
}