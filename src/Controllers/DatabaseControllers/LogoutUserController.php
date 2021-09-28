<?php

namespace App\Controllers\DatabaseControllers;
use Psr\Container\ContainerInterface;

class LogoutUserController
{
	private ContainerInterface $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	public function __invoke($request, $response, $args)
	{
		session_destroy();
		return $response->withStatus(200)->withHeader('Location', './login');
	}
}