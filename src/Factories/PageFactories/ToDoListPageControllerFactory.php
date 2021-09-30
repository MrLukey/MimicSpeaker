<?php

namespace App\Factories\PageFactories;
use App\Controllers\PageControllers\ToDoListPageController;
use Psr\Container\ContainerInterface;

class ToDoListPageControllerFactory
{
	public function __invoke(ContainerInterface $container): ToDoListPageController
	{
		return new ToDoListPageController($container);
	}
}