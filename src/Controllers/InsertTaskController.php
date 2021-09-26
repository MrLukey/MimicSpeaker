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
		$taskData = $request->getParsedBody();
		if ($taskData['taskTitle'] === '')
			return $response->withStatus(500)->withHeader('Location', './');
		$taskText = $taskData['taskText'] | '';
		$errorData = $taskModel->insertTask($taskData['taskTitle'], $taskText);
		if ($errorData) {
			$errorLogger = $this->container->get('errorLoggerModel');
			$errorLogger->logDatabaseError($errorData['cause'], $errorData['exception']);
			$status = 500;
		} else
			$status = 200;
		return $response->withStatus($status)->withHeader('Location', './');
	}
}