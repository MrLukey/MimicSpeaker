<?php

namespace App\Controllers\DatabaseControllers;
use Psr\Container\ContainerInterface;

class SignUpNewUserController
{
	private ContainerInterface $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	public function __invoke($request, $response, $args)
	{
		$_SESSION['error'] = true;
		$userInputData = $request->getParsedBody();
		if ($userInputData['userName'] === '' || $userInputData['rawPassword'] === '') {
			$_SESSION['errorMessage'] ='Username and password must be provided.';
			return $response->withStatus(500)->withHeader('Location', './signup');
		}
		$userModel = $this->container->get('userModel');
		$hashPassword = password_hash($userInputData['rawPassword'], PASSWORD_DEFAULT);
		$errorData = $userModel->insertNewUser($userInputData['userName'], $hashPassword);
		if ($errorData) {
			$errorLogger = $this->container->get('errorLoggerModel');
			$errorLogger->logDatabaseError($errorData['cause'], $errorData['exception']);
			$_SESSION['error'] = true;
			$_SESSION['errorMessage'] = 'Username is already taken.';
		} else {
			$userData = $userModel->getUserByName($userInputData['userName']);
			if (isset($userData['exception'])){
				$errorLogger = $this->container->get('errorLoggerModel');
				$errorLogger->logDatabaseError($userData['cause'], $userData['exception']);
			} else {
				$_SESSION['loggedIn'] = true;
				$_SESSION['user'] = $userData[0];
				$_SESSION['error'] = false;
				$_SESSION['errorMessage'] = '';
				return $response->withStatus(200)->withHeader('Location', './');
			}
		}
		return $response->withStatus(500)->withHeader('Location', './signup');
	}
}