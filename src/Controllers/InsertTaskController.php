<?php

namespace App\Controllers;
use Psr\Container\ContainerInterface;

class InsertTaskController
{
	private ContainerInterface $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	public function __invoke($request, $response, $args)
	{
		$taskModel = $this->container->get('taskModel');
		$taskText = $request->getParsedBody()['taskText'];
		$errorData = $taskModel->insertTask($taskText);
		if ($errorData) {
			$errorLogger = $this->container->get('errorLoggerModel');
			$errorLogger->logDatabaseError($errorData['cause'], $errorData['exception']);
			return $response->withStatus(500)->withHeader('Location', './incomplete');
		} else {
			return $response->withStatus(200)->withHeader('Location', './incomplete');
		}
	}
}