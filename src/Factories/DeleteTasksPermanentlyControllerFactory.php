<?php

namespace App\Factories;
use App\Controllers\DeleteTasksPermanentlyController;
use Psr\Container\ContainerInterface;

class DeleteTasksPermanentlyControllerFactory
{
	public function __invoke(ContainerInterface $container): DeleteTasksPermanentlyController
	{
		return new DeleteTasksPermanentlyController($container);
	}
}