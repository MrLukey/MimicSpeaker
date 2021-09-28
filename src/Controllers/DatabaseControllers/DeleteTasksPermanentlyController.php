<?php

namespace App\Controllers\DatabaseControllers;
use Psr\Container\ContainerInterface;

class DeleteTasksPermanentlyController
{
	private ContainerInterface $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	public function __invoke($request, $response, $args)
	{
		if ($_SESSION['loggedIn'] && $_SESSION['user'] !== null){
			$error = false;
			$taskModel = $this->container->get('taskModel');
			$tasksToDeletePermanently = $request->getParsedBody();
			foreach ($tasksToDeletePermanently as $key => $value){
				$taskID = intval(mb_substr($key, 4)); // extract ID from task{ID}="on" checkbox inputs
				$errorData = $taskModel->deleteTaskPermanently($taskID);
				if ($errorData){
					$errorLogger = $this->container->get('errorLoggerModel');
					$errorLogger->logDatabaseError($errorData['cause'], $errorData['exception']);
					$error = true;
				}
			}
			$status = $error ? 500 : 200;
			return $response->withStatus($status)->withHeader('Location', './');
		}
		return $response->withStatus(500)->withHeader('Location', './login');
	}
}