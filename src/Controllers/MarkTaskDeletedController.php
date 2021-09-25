<?php

namespace App\Controllers;
use Psr\Container\ContainerInterface;

class MarkTaskDeletedController
{
	private ContainerInterface $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	public function __invoke($request, $response, $args)
	{
		$taskModel = $this->container->get('taskModel');
		$errorLogger = $this->container->get('errorLoggerModel');
		$error = false;
		$tasksToDelete = $request->getParsedBody();
		foreach ($tasksToDelete as $key => $value){
			$taskID = intval(mb_substr($key, 4)); // extract ID from task{ID}="on" checkbox inputs
			$errorData = $taskModel->markTaskDeleted($taskID);
			if ($errorData){
				$errorLogger->logDatabaseError($errorData['cause'], $errorData['exception']);
				$error = true;
			}
		}
		if ($error){
			return $response->withStatus(500)->withHeader('Location', './complete');
		} else {
			return $response->withStatus(200)->withHeader('Location', './complete');
		}
	}
}