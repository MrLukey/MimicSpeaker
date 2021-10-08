<?php

namespace App\Controllers\MimicSpeakerControllers;
use Psr\Container\ContainerInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class BuildMimicSpeakerController
{
	private ContainerInterface $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	public function __invoke(Request $request, Response $response, array $args)
	{
		$_SESSION['error'] = true;
		$mimicSpeaker = $this->container->get('mimicSpeakerEntity');
		$mimicParams = $request->getParsedBody();
		$errorLogger = $this->container->get('errorLoggerModel');
		$errorLogger->logTestJSON($mimicParams);
		$mimicSpeakerModel = $this->container->get('mimicSpeakerModel');
		if($mimicParams['shortTitle'] !== ''){
			$textData = $mimicSpeakerModel->getProcessedTextByShortTitle($mimicParams['shortTitle'])[0];
		} elseif ($mimicParams['genre'] !== ''){
			$textData = $mimicSpeakerModel->getProcessedTextsByGenre($mimicParams['genre']);
		} else {
			$textData = $mimicSpeakerModel->getRandomProcessedText()[0];
		}
		$mimicSpeaker->buildFromJSON($textData['file_path'], $textData['short_title'], $textData['genre']);
		$_SESSION['mimicSpeaker'] = $mimicSpeaker;
		return $response->withStatus(200)->withHeader('Location', './');
	}
}