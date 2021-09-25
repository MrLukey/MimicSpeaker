<?php

namespace App\Factories;
use App\Controllers\MarkTaskNotDeletedController;
use Psr\Container\ContainerInterface;

class MarkTaskNotDeletedControllerFactory
{
	public function __invoke(ContainerInterface $container): MarkTaskNotDeletedController
	{
		return new MarkTaskNotDeletedController($container);
	}
}