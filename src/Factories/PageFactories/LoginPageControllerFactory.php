<?php

namespace App\Factories\PageFactories;
use App\Controllers\PageControllers\LoginPageController;
use Psr\Container\ContainerInterface;

class LoginPageControllerFactory
{
	public function __invoke(ContainerInterface $container): LoginPageController
	{
		return new LoginPageController($container);
	}
}