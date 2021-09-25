<?php

namespace App\Controllers;
use Psr\Container\ContainerInterface;

class MarkTaskIncompleteController
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
		$tasksToMarkIncomplete = $request->getParsedBody();
		foreach ($tasksToMarkIncomplete as $key => $value){
			$taskID = intval(mb_substr($key, 4)); // extract ID from task{ID}="" form input
			$errorData = $taskModel->markTaskIncomplete($taskID);
			if ($errorData){
				$errorLogger->logDatabaseError($errorData['cause'], $errorData['exception']);
				$error = true;
			}
		}
		$status = $error ? 500 : 200;
		return $response->withStatus($status)->withHeader('Location', './');
	}
}