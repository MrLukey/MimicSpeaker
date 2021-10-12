<?php

namespace App\Controllers\MimicSpeakerControllers;
use Psr\Container\ContainerInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class PublishMimicController
{
	private ContainerInterface $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	public function __invoke(Request $request, Response $response, array $args): Response
	{
		$mimicData = $request->getParsedBody();
		$errorLogger = $this->container->get('errorLoggerModel');
		$editedMimicSpeech = $_SESSION['mimicSpeech'];
		foreach ($mimicData as $wordData){
			$errorLogger->logTestJSON($wordData);
			$wordIndex = $wordData['id'];
			if ($wordData['deleted'] === 'true'){
				unset($editedMimicSpeech[$wordIndex]);
			}
			else{
				if ($wordData['punctuated'] === 'true'){
					switch ($wordData['punctuation']){
						case 'comma':
							$editedMimicSpeech[$wordIndex] = $editedMimicSpeech[$wordIndex] . ',';
							break;
						case 'fullStop':
							$editedMimicSpeech[$wordIndex] = $editedMimicSpeech[$wordIndex] . '.';
							break;
						case 'semiColon':
							$editedMimicSpeech[$wordIndex] = $editedMimicSpeech[$wordIndex] . ';';
							break;
						case 'colon':
							$editedMimicSpeech[$wordIndex] = $editedMimicSpeech[$wordIndex] . ':';
							break;
						case 'exclamation':
							$editedMimicSpeech[$wordIndex] = $editedMimicSpeech[$wordIndex] . '!';
							break;
						case 'question':
							$editedMimicSpeech[$wordIndex] = $editedMimicSpeech[$wordIndex] . '?';
							break;
						default:
					}
				}
				if ($wordData['capitalised'] === 'true'){
					switch ($wordData['capitalisation']){
						case 'firstCaps':
							$editedMimicSpeech[$wordIndex] = ucfirst($editedMimicSpeech[$wordIndex]);
							break;
						case 'allCaps':
							$editedMimicSpeech[$wordIndex] = strtoupper($editedMimicSpeech[$wordIndex]);
							break;
						default:
					}
				}
			}
		}
		if (count($editedMimicSpeech) > 5){
			$mimicString = '';
			foreach ($editedMimicSpeech as $editedWord){
				$mimicString .= $editedWord . ' ';
			}
			$mimicString = substr($mimicString, 0, strlen($mimicString) - 1);
			$errorLogger->logTestJSON($mimicString);
			$mimicSpeakerModel = $this->container->get('mimicSpeakerModel');
			$success = $mimicSpeakerModel->insertMimic($_SESSION['user']->getID(), $_SESSION['mimicSpeaker']->getBuiltFromIDs()[0], $mimicString);
			if (!$success){
				$response->getBody()->write(json_encode(['error'=> 'Unexpected database error.']));
				return $response->withStatus(500);
			} else {
				$_SESSION['mimicSpeech'] = [];
				$activityLogger = $this->container->get('activityLoggerModel');
				$activityLogger->logMimicPublished($_SESSION['user']->getID());
				$response->getBody()->write(json_encode(['success'=> 'Mimic was published successfully.']));
				return $response->withStatus(200);
			}
		} else {
			$response->getBody()->write(json_encode(['error'=> 'String must be 5 words or more']));
			return $response->withStatus(418);
		}
	}
}