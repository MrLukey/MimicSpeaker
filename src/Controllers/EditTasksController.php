<?php

namespace App\Controllers;
use Psr\Container\ContainerInterface;

class EditTasksController
{
	private ContainerInterface $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	public function __invoke($request, $response, $args)
	{
		$errorLogger = $this->container->get('errorLoggerModel');
		$taskData = $request->getParsedBody();
		$editFunction = $taskData['editFunction'];

		$errorLogger->logJsonData($tasksToEdit);
		return $response->withStatus(200)->withHeader('Location', './');
	}
}