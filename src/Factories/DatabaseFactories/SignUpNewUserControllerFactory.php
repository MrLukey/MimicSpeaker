<?php

namespace App\Factories\DatabaseFactories;
use App\Controllers\DatabaseControllers\SignUpNewUserController;
use Psr\Container\ContainerInterface;

class SignUpNewUserControllerFactory
{
	public function __invoke(ContainerInterface $container): SignUpNewUserController
	{
		return new SignUpNewUserController($container);
	}
}