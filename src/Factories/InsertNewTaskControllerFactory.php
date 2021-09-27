<?php

namespace App\Factories;
use App\Controllers\InsertNewTaskController;
use Psr\Container\ContainerInterface;

class InsertNewTaskControllerFactory
{
	public function __invoke(ContainerInterface $container): InsertNewTaskController
	{
		return new InsertNewTaskController($container);
	}
}