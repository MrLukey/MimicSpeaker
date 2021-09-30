<?php

namespace App\Factories\PageFactories;
use App\Controllers\PageControllers\SignUpPageController;
use Psr\Container\ContainerInterface;

class SignUpPageControllerFactory
{
	public function __invoke(ContainerInterface $container): SignUpPageController
	{
		return new SignUpPageController($container);
	}
}