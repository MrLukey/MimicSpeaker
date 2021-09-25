<?php

namespace App\Controllers;
use Psr\Container\ContainerInterface;

class CompletedTasksController
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
		$taskData = $taskModel->getCompletedTasks();
		if ($taskData['exception']){
			$errorLogger = $this->container->get('errorLoggerModel');
			$errorLogger->logDatabaseError($taskData['cause'], $taskData['exception'], new \DateTime());
		}
		return $renderer->render($response, 'completedTasks.php', $taskData);
	}
}