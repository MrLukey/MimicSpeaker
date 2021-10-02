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
			$taskModel = $this->container->get('taskModel');
			$tasksToDelete = $request->getParsedBody();
			foreach ($tasksToDelete as $key => $value){
				$taskID = intval(mb_substr($key, 4)); // extract ID from task{ID}="" form inputs
				$success = $taskModel->deleteTaskPermanently($taskID, $_SESSION['user']->getID());
				if (!$success){
					$_SESSION['error'] = true;
					$_SESSION['errorMessage'] = 'A task was not deleted.';
				}
			}
			$status = $_SESSION['error'] ? 500 : 200;
			return $response->withStatus($status)->withHeader('Location', './');
		}
		return $response->withStatus(500)->withHeader('Location', './login');
	}
}