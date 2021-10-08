<?php

namespace App\Controllers\PageControllers;

use Psr\Container\ContainerInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class AdminPageController
{
	private ContainerInterface $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	public function __invoke(Request $request, Response $response, array $args)
	{
		$renderer = $this->container->get('renderer');
		$mimicSpeakerModel = $this->container->get('mimicSpeakerModel');
		$data['mimics'] = $mimicSpeakerModel->getMimics();
		$data['processedTexts'] = $mimicSpeakerModel->getAllProcessedTexts();
		return $renderer->render($response, 'admin.php', $data);
	}
}