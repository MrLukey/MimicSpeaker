<?php

namespace App\Controllers\PageControllers;
use Psr\Container\ContainerInterface;

class LoginPageController
{
	private ContainerInterface $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	public function __invoke($request, $response, $args)
	{
		$renderer = $this->container->get('renderer');
		return $renderer->render($response, 'login.php', $args);
	}
}