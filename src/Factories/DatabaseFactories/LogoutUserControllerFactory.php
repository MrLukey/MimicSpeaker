<?php

namespace App\Factories\DatabaseFactories;
use App\Controllers\DatabaseControllers\LogoutUserController;
use Psr\Container\ContainerInterface;

class LogoutUserControllerFactory
{
	public function __invoke(ContainerInterface $container): LogoutUserController
	{
		return new LogoutUserController($container);
	}
}