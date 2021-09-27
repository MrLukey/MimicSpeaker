<?php

namespace App\Factories\DatabaseFactories;
use App\Controllers\DatabaseControllers\InsertNewUserController;
use Psr\Container\ContainerInterface;

class InsertNewUserControllerFactory
{
	public function __invoke(ContainerInterface $container): InsertNewUserController
	{
		return new InsertNewUserController($container);
	}
}