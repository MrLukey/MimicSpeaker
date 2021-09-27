<?php

namespace App\Factories;
use App\Controllers\LoginPageController;
use Psr\Container\ContainerInterface;

class LoginPageControllerFactory
{
	public function __invoke(ContainerInterface $container): LoginPageController
	{
		return new LoginPageController($container);
	}
}