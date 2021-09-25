<?php

namespace App\Factories;
use Psr\Container\ContainerInterface;
use App\Controllers\MarkTaskDeletedController;

class MarkTaskDeletedControllerFactory
{
	public function __invoke(ContainerInterface $container): MarkTaskDeletedController
	{
		return new MarkTaskDeletedController($container);
	}
}