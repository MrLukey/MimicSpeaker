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

	public function __invoke(Request $request, Response $response, array $args): Response
	{
		if ($_SESSION['mimicSpeaker'] === null){
			$_SESSION['error'] = true;
			$_SESSION['errorMessage'] = 'No mimic speaker exists, please build one.';
			return $response->withStatus(500);
		} else {
			$mimicArgs = $request->getParsedBody();
			$sentenceLength = $mimicArgs['sentenceLength'] > 1000 ? 1000: $mimicArgs['sentenceLength'];
			$mimicSpeech = $_SESSION['mimicSpeaker']->mimic($sentenceLength);
			$mimicSpeech[0] = ucfirst($mimicSpeech[0]);
			$mimicSpeech[array_key_last($mimicSpeech)] = $mimicSpeech[array_key_last($mimicSpeech)] . '.';
			$_SESSION['mimicSpeech'] = $mimicSpeech;
			$activityLogger = $this->container->get('activityLoggerModel');
			$activityLogger->logMimicGenerated($_SESSION['user']->getID());
			$response->getBody()->write(json_encode($mimicSpeech));
			return $response->withStatus(200);
		}
	}
}