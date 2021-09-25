<?php

namespace App\Factories;
use Psr\Container\ContainerInterface;
use App\Controllers\RecoverDeletedTaskController;

class RecoverDeletedTaskControllerFactory
{
	public function __invoke(ContainerInterface $container): RecoverDeletedTaskController
	{
		return new RecoverDeletedTaskController($container);
	}
}