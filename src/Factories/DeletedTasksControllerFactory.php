<?php

namespace App\Factories;
use App\Controllers\DeletedTasksController;
use Psr\Container\ContainerInterface;

class DeletedTasksControllerFactory
{
	public function __invoke(ContainerInterface $container): DeletedTasksController
	{
		return new DeletedTasksController($container);
	}
}