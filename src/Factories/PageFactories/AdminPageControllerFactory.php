<?php

namespace App\Factories\PageFactories;
use App\Controllers\PageControllers\AdminPageController;
use Psr\Container\ContainerInterface;

class AdminPageControllerFactory
{
	public function __invoke(ContainerInterface $container): AdminPageController
	{
		return new AdminPageController($container);
	}
}