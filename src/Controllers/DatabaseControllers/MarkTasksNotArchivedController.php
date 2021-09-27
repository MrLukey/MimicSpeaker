<?php

namespace App\Controllers\DatabaseControllers;
use Psr\Container\ContainerInterface;

class MarkTasksNotArchivedController
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
		$tasksToMarkNotDeleted = $request->getParsedBody();
		foreach ($tasksToMarkNotDeleted as $key => $value){
			$taskID = intval(mb_substr($key, 4)); // extract ID from task{ID}="on" checkbox inputs
			$errorData = $taskModel->markTaskNotArchived($taskID);
			if ($errorData){
				$errorLogger->logDatabaseError($errorData['cause'], $errorData['exception']);
				$error = true;
			}
		}
		$status = $error ? 500 : 200;
		return $response->withStatus($status)->withHeader('Location', './');
	}
}