<?php

namespace App\Factories\DatabaseFactories;
use App\Controllers\DatabaseControllers\InsertNewTaskController;
use Psr\Container\ContainerInterface;

class InsertNewTaskControllerFactory
{
	public function __invoke(ContainerInterface $container): InsertNewTaskController
	{
		return new InsertNewTaskController($container);
	}
}