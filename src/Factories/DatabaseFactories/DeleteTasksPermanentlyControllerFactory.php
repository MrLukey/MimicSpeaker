<?php

namespace App\Factories\DatabaseFactories;
use App\Controllers\DatabaseControllers\DeleteTasksPermanentlyController;
use Psr\Container\ContainerInterface;

class DeleteTasksPermanentlyControllerFactory
{
	public function __invoke(ContainerInterface $container): DeleteTasksPermanentlyController
	{
		return new DeleteTasksPermanentlyController($container);
	}
}