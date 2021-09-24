<?php

namespace App\Controllers;
use Psr\Container\ContainerInterface;

class MarkTaskCompleteController
{
	private ContainerInterface $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	public function __invoke($request, $response, $args)
	{
		$taskModel = $this->container->get('taskModel');
		$completedTasks = $request->getParsedBody();
		foreach ($completedTasks as $key => $value){
			$taskID = intval(mb_substr($key, 4)); // remove "task" from "task{ID}" value of form input
			$taskModel->markTaskComplete($taskID);
		}
		return $response->withStatus(200)->withHeader('Location', './incomplete');
	}
}