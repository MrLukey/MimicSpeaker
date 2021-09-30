<?php

namespace App\Controllers\DatabaseControllers;
use Psr\Container\ContainerInterface;

class EditAllTasksController
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
		$taskData = $request->getParsedBody();
		$editFunction = $taskData['editFunction'];
		unset($taskData['editFunction']);
		foreach ($taskData as $key => $value) {
			$taskID = intval(mb_substr($key, 4)); // extract ID from task{ID}="on" checkbox inputs
			switch ($editFunction) {
				case 'Complete':
					$errorData = $taskModel->markTaskComplete($taskID);
					break;
				case 'Delete':
					$errorData = $taskModel->markTaskDeleted($taskID);
					break;
				case 'Recover':
					$errorData = $taskModel->recoverDeletedTask($taskID);
					break;
				default:
					$errorData = false;
			}
			if ($errorData)
				$errorLogger->logDatabaseError($errorData['cause'], $errorData['exception']);
		}
		return $response->withStatus(200)->withHeader('Location', './');
	}
}