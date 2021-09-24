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
		return $renderer->render($response, 'completedTasks.php', $taskModel->getCompletedTasks());
	}
}