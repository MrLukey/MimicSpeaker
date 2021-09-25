<?php
namespace App\Controllers;
use Psr\Container\ContainerInterface;

class AllTasksController
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
		$taskData = $taskModel->getAllTasks();
		if (isset($taskData['exception'])){
			$errorLogger = $this->container->get('errorLoggerModel');
			$errorLogger->logDatabaseError($taskData['cause'], $taskData['exception']);
		}
		return $renderer->render($response, 'index.php', $taskData);
	}
}