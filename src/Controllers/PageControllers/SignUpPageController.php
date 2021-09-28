<?php

namespace App\Controllers\PageControllers;
use Psr\Container\ContainerInterface;

class SignUpPageController
{
	private ContainerInterface $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	public function __invoke($request, $response, $args)
	{
		if ($_SESSION['loggedIn'] && $_SESSION['user'] !== null)
			return $response->withStatus(200)->withHeader('Location', '/');
		$renderer = $this->container->get('renderer');
		return $renderer->render($response, 'signUpPage.php', $args);
	}
}