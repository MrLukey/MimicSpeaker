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

	public function __invoke(Request $request, Response $response, array $args): Response
	{
		$_SESSION['error'] = true;
		$_SESSION['mimicSpeech'] = [];
		$mimicSpeaker = $this->container->get('mimicSpeakerEntity');
		$mimicParams = $request->getParsedBody();
		$mimicSpeakerModel = $this->container->get('mimicSpeakerModel');
		if($mimicParams['shortTitle'] !== ''){
			$textData = $mimicSpeakerModel->getProcessedTextByShortTitle($mimicParams['shortTitle'])[0];
		} elseif ($mimicParams['genre'] !== ''){
			$textData = $mimicSpeakerModel->getRandomProcessedTextByGenre($mimicParams['genre'])[0];
		} else {
			$textData = $mimicSpeakerModel->getRandomProcessedText()[0];
		}
		$mimicSpeaker->buildFromJSON($textData['file_path'], $textData['short_title'], $textData['full_title'],$textData['author'], $textData['genre']);
		$_SESSION['mimicSpeaker'] = $mimicSpeaker;
		$mimicSpeakerData = [
			'shortTitle' => $mimicSpeaker->getBuiltFromShortTitles()[0],
			'longTitle' => $mimicSpeaker->getBuiltFromLongTitles()[0],
			'author' => $mimicSpeaker->getBuiltFromAuthors()[0],
			'genre' => $mimicSpeaker->getBuiltFromGenres()[0]
		];
		$response->getBody()->write(json_encode($mimicSpeakerData));
		return $response->withStatus(200);
	}
}