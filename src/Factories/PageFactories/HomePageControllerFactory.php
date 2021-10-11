<?php

namespace App\Factories\PageFactories;
use App\Controllers\PageControllers\HomePageController;
use Psr\Container\ContainerInterface;

class HomePageControllerFactory
{
	public function __invoke(ContainerInterface $container): HomePageController
	{
		return new HomePageController($container);
	}
}