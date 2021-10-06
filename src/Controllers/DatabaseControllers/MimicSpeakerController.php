<?php

namespace App\Controllers\DatabaseControllers;
use Psr\Container\ContainerInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class MimicSpeakerController
{
	private ContainerInterface $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	public function __invoke(Request $request, Response $response, array $args)
	{
		$errorLogger = $this->container->get('errorLoggerModel');
		$mimicSpeakerModel = $this->container->get('mimicSpeakerModel');
		$mimicSpeaker = $this->container->get('mimicSpeakerEntity');
		$mimicParams = $request->getParsedBody();
		$errorLogger->logTestJSON($mimicParams);
		if($mimicParams['shortTitle'] !== ''){
			$textData = $mimicSpeakerModel->getProcessedTextByShortTitle($mimicParams['shortTitle'])[0];
		} elseif ($mimicParams['genre'] !== ''){
			$textData = $mimicSpeakerModel->getProcessedTextsByGenre($mimicParams['genre']);
		} else {
			$textData = $mimicSpeakerModel->getRandomProcessedText()[0];
		}
		$mimicSpeaker->buildFromJSON($textData['file_path']);
		$_SESSION['mimicSpeech'] = $mimicSpeaker->mimic($mimicParams['sentenceLength']);
		return $response->withStatus(200)->withHeader('Location', './');
	}
}