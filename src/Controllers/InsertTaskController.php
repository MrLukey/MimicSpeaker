<?php

namespace App\Controllers;
use Psr\Container\ContainerInterface;

class InsertTaskController
{
	private ContainerInterface $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	public function __invoke($request, $response, $args)
	{
		$taskModel = $this->container->get('taskModel');
		$taskText = $request->getParsedBody()['taskText'];
		$taskModel->insertNewTask($taskText);
		return $response->withStatus(200)->withHeader('Location', './incomplete');
	}
}