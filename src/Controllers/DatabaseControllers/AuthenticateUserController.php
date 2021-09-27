<?php

namespace App\Controllers\DatabaseControllers;
use Psr\Container\ContainerInterface;

class AuthenticateUserController
{
	private ContainerInterface $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	public function __invoke($request, $response, $args)
	{
		$userModel = $this->container->get('userModel');
		$errorLogger = $this->container->get('errorLoggerModel');
		$userData = $request->getParsedBody();
		$hashPassword = password_hash($userData['rawPassword'], PASSWORD_DEFAULT);
		$errorData = $userModel->authenticateUser($userData['userName'], $hashPassword);
		if ($errorData) {
			$errorLogger->logDatabaseError($errorData['cause'], $errorData['exception']);
			return $response->withStatus(500)->withHeader('Location', './login');
		} else {
			return $response->withStatus(200)->withHeader('Location', './');
		}
	}
}