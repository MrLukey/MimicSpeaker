<?php

namespace App\Controllers\DatabaseControllers;
use Psr\Container\ContainerInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class EditAllTasksController
{
	private ContainerInterface $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	public function __invoke(Request $request, Response $response, array $args)
	{
		if ($_SESSION['loggedIn'] && $_SESSION['user'] !== null) {
			$taskModel = $this->container->get('taskModel');
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
				if ($errorData){
					$errorLogger = $this->container->get('errorLoggerModel');
					$errorLogger->logDatabaseError($errorData['cause'], $errorData['exception']);
					$_SESSION['error'] = true;
					$_SESSION['errorMessage'] = 'An unexpected error occurred.';
				}
			}
			return $response->withStatus(200)->withHeader('Location', './');
		}
		return $response->withStatus(500)->withHeader('Location', './login');
	}
}