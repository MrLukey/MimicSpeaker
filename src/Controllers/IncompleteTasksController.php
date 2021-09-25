<?php

namespace App\Controllers;
use Psr\Container\ContainerInterface;

class IncompleteTasksController
{
	private ContainerInterface $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	public function __invoke($request, $response, $args)
	{
		$renderer = $this->container->get('renderer');
		$taskModel = $this->container->get('taskModel');
		$taskData = $taskModel->getIncompleteTasks();
		if (isset($taskData['exception'])){
			$errorLogger = $this->container->get('errorLoggerModel');
			$errorLogger->logDatabaseError($taskData['cause'], $taskData['exception'], new \DateTime());
		}
		return $renderer->render($response, 'incompleteTasks.php', $taskData);
	}
}