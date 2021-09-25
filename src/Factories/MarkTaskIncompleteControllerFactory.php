<?php

namespace App\Factories;
use App\Controllers\MarkTaskIncompleteController;
use Psr\Container\ContainerInterface;

class MarkTaskIncompleteControllerFactory
{
	public function __invoke(ContainerInterface $container): MarkTaskIncompleteController
	{
		return new MarkTaskIncompleteController($container);
	}
}