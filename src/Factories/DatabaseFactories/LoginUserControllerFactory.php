<?php

namespace App\Factories\DatabaseFactories;
use App\Controllers\DatabaseControllers\LoginUserController;
use Psr\Container\ContainerInterface;

class LoginUserControllerFactory
{
	public function __invoke(ContainerInterface $container): LoginUserController
	{
		return new LoginUserController($container);
	}
}