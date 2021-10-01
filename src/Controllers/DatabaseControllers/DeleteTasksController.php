<?php

namespace App\Controllers\DatabaseControllers;
use Psr\Container\ContainerInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class DeleteTasksController
{
	private ContainerInterface $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	public function __invoke(Request $request, Response $response, array $args)
	{
		if ($_SESSION['loggedIn'] && $_SESSION['user'] !== null){
			$_SESSION['error'] = false;
			$taskModel = $this->container->get('taskModel');
			$tasksToDelete = $request->getParsedBody();
			foreach ($tasksToDelete as $key => $value){
				$taskID = intval(mb_substr($key, 4)); // extract ID from task{ID}="" form inputs
				$errorData = $taskModel->deleteTaskPermanently($taskID);
				if ($errorData){
					$errorLogger = $this->container->get('errorLoggerModel');
					$errorLogger->logDatabaseError($errorData['cause'], $errorData['exception']);
					$_SESSION['error'] = true;
					$_SESSION['errorMessage'] = 'A task was not deleted.';
				} else {
					$activityLogger = $this->container->get('activityLoggerModel');
					$errorData = $activityLogger->logTaskDeleted($_SESSION['user']->getID());
					if ($errorData){
						$errorLogger = $this->container->get('errorLoggerModel');
						$errorLogger->logDatabaseError($errorData['cause'], $errorData['exception']);
					}
				}
			}
			$status = $_SESSION['error'] ? 500 : 200;
			return $response->withStatus($status)->withHeader('Location', './');
		}
		return $response->withStatus(500)->withHeader('Location', './login');
	}
}