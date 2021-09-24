<?php

namespace App\Factories;
use App\Controllers\IncompleteTaskController;
use Psr\Container\ContainerInterface;

class IncompleteTaskControllerFactory
{
	public function __invoke(ContainerInterface $container): IncompleteTaskController
	{
		return new IncompleteTaskController($container);
	}
}