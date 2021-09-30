<?php
namespace App\Controllers\PageControllers;
use Psr\Container\ContainerInterface;

class ToDoListPageController
{
	private ContainerInterface $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	public function __invoke($request, $response, $args)
	{
		if ($_SESSION['loggedIn'] && $_SESSION['user'] !== null) {
			$renderer = $this->container->get('renderer');
			$taskModel = $this->container->get('taskModel');
			$taskData = $taskModel->getAllTasksForUser($_SESSION['user']->getID());
			if (isset($taskData['exception'])){
				$errorLogger = $this->container->get('errorLoggerModel');
				$errorLogger->logDatabaseError($taskData['cause'], $taskData['exception']);
			}
			return $renderer->render($response, 'index.php', $taskData);
		} else
			return $response->withStatus(500)->withHeader('Location', '/login');
	}
}