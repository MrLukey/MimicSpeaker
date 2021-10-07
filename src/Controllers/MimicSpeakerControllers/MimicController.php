<?php

namespace App\Controllers\MimicSpeakerControllers;

use Psr\Container\ContainerInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class MimicController
{
	private ContainerInterface $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	public function __invoke(Request $request, Response $response, array $args)
	{
		if ($_SESSION['mimicSpeaker'] === null){
			$_SESSION['error'] = true;
			$_SESSION['errorMessage'] = 'No mimic speaker exists, please build one.';
			return $response->withStatus(500)->withHeader('Location', './');
		} else {
			$mimicArgs = $request->getParsedBody();
			$_SESSION['mimicSpeech'] = $_SESSION['mimicSpeaker']->mimic($mimicArgs['sentenceLength']);
			return $response->withStatus(200)->withHeader('Location', './');
		}
	}
}