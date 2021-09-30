<?php

namespace App\Controllers\DatabaseControllers;
use Psr\Container\ContainerInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class InsertNewTaskController
{
	private ContainerInterface $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	public function __invoke(Request $request, Response $response, array $args)
	{   $_SESSION['error'] = true;
		if ($_SESSION['loggedIn'] && $_SESSION['user'] !== null) {
			$taskData = $request->getParsedBody();
			if ($taskData['taskTitle'] === '') {
				$_SESSION['errorMessage'] = 'Tasks require at least a title.';
			} else {
				$taskText = $taskData['taskText'] | '';
				$taskModel = $this->container->get('taskModel');
				$errorData = $taskModel->insertTask($_SESSION['user']->getID(), $taskData['taskTitle'], $taskText);
				if ($errorData) {
					$errorLogger = $this->container->get('errorLoggerModel');
					$errorLogger->logDatabaseError($errorData['cause'], $errorData['exception']);
					$_SESSION['errorMessage'] = 'Task was not added.';
					$status = 500;
				} else {
					$status = 200;
					$_SESSION['error'] = false;
				}
			}
			return $response->withStatus($status)->withHeader('Location', './');
		}
		return $response->withStatus(500)->withHeader('Location', './login');
	}
}