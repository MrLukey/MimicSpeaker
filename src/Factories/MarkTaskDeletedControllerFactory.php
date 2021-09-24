<?php

namespace App\Factories;
use App\Controllers\MarkTaskDeletedController;
use Psr\Container\ContainerInterface;

class MarkTaskDeletedControllerFactory
{
	public function __invoke(ContainerInterface $container): MarkTaskDeletedController
	{
		return new MarkTaskDeletedController($container);
	}
}