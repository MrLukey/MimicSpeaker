<?php

namespace App\Factories;
use App\Controllers\ToDoListPageController;
use Psr\Container\ContainerInterface;

class ToDoListPageControllerFactory
{
	public function __invoke(ContainerInterface $container): ToDoListPageController
	{
		return new ToDoListPageController($container);
	}
}