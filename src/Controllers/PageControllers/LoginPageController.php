<?php

namespace App\Controllers\PageControllers;
use Psr\Container\ContainerInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class LoginPageController
{
	private ContainerInterface $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	public function __invoke(Request $request, Response $response, array $args)
	{
		if ($_SESSION['loggedIn'] && $_SESSION['user'] !== null)
			return $response->withStatus(200)->withHeader('Location', '/');
		$renderer = $this->container->get('renderer');
		return $renderer->render($response, 'loginPage.php', $args);
	}
}