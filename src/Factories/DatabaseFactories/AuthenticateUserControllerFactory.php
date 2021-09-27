<?php

namespace App\Factories\DatabaseFactories;
use App\Controllers\DatabaseControllers\AuthenticateUserController;
use Psr\Container\ContainerInterface;

class AuthenticateUserControllerFactory
{
	public function __invoke(ContainerInterface $container): AuthenticateUserController
	{
		return new AuthenticateUserController($container);
	}
}