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
	{
		if ($_SESSION['loggedIn'] && $_SESSION['user'] !== null) {
			$taskData = $request->getParsedBody();
			if ($taskData['taskTitle'] === '') {
				$_SESSION['errorMessage'] = 'Tasks require at least a title.';
			} else {
				$taskText = $taskData['taskText'] | '';
				$taskModel = $this->container->get('taskModel');
				$success = $taskModel->insertTask($_SESSION['user']->getID(), $taskData['taskTitle'], $taskText);
				if (!$success) {
					$_SESSION['error'] = true;
					$_SESSION['errorMessage'] = 'A task was not added.';
				}
				$status = $_SESSION['error'] ? 500 : 200;
				return $response->withStatus($status)->withHeader('Location', './');
			}
		}
		return $response->withStatus(500)->withHeader('Location', './login');
	}
}