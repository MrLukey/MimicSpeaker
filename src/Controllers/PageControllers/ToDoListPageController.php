<?php
namespace App\Controllers\PageControllers;
use Psr\Container\ContainerInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class ToDoListPageController
{
	private ContainerInterface $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	public function __invoke(Request $request, Response $response, array $args)
	{
		if ($_SESSION['loggedIn'] && $_SESSION['user'] !== null) {
			$renderer = $this->container->get('renderer');
			$taskModel = $this->container->get('taskModel');
			$taskData = $taskModel->getAllTasksForUser($_SESSION['user']->getID());
			if (isset($taskData['exception'])){
				$errorLogger = $this->container->get('errorLoggerModel');
				$errorLogger->logDatabaseError($taskData['cause'], $taskData['exception']);
				$_SESSION['error'] = true;
				$_SESSION['errorMessage'] = 'An unexpected error occurred.';
			}
			return $renderer->render($response, 'index.php', $taskData);
		}
		return $response->withStatus(500)->withHeader('Location', '/login');
	}
}