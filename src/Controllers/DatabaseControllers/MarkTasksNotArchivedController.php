<?php

namespace App\Controllers\DatabaseControllers;
use Psr\Container\ContainerInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class MarkTasksNotArchivedController
{
	private ContainerInterface $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	public function __invoke(Request $request, Response $response, array $args)
	{
		if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
			$_SESSION['error'] = false;
			$taskModel = $this->container->get('taskModel');
			$taskToMarkNotArchived = $request->getParsedBody();
			foreach ($taskToMarkNotArchived as $key => $value) {
				$taskID = intval(mb_substr($key, 4)); // extract ID from task{ID}="" form inputs
				$errorData = $taskModel->markTaskNotArchived($taskID);
				if ($errorData) {
					$errorLogger = $this->container->get('errorLoggerModel');
					$errorLogger->logDatabaseError($errorData['cause'], $errorData['exception']);
					$_SESSION['error'] = true;
					$_SESSION['errorMessage'] = 'A task was not archived.';
				}
			}
			$status = $_SESSION['error'] ? 500 : 200;
			return $response->withStatus($status)->withHeader('Location', './');
		}
		return $response->withStatus(500)->withHeader('Location', './login');
	}
}