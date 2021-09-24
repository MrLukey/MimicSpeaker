<?php

namespace App\Factories;
use App\Controllers\InsertTaskController;
use Psr\Container\ContainerInterface;

class InsertTaskControllerFactory
{
	public function __invoke(ContainerInterface $container): InsertTaskController
	{
		return new InsertTaskController($container);
	}
}