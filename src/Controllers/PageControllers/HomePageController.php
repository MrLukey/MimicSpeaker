<?php

namespace App\Controllers\PageControllers;

use Psr\Container\ContainerInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class HomePageController
{
	private ContainerInterface $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	public function __invoke(Request $request, Response $response, array $args)
	{
		$mimicSpeakerModel = $this->container->get('mimicSpeakerModel');
		$renderer = $this->container->get('renderer');
		$mimics = $mimicSpeakerModel->getMimics();
		return $renderer->render($response, 'homepage.php', $mimics);
	}
}