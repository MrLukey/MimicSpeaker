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
		$_SESSION['errorMessage'] = 'An unexpected error occurred';
		$userInputData = $request->getParsedBody();
		$errorLogger = $this->container->get('errorLoggerModel');
		$errorLogger->logTestJSON($userInputData);
		if ($userInputData['username'] === '' || $userInputData['email'] === '' || $userInputData['rawPassword'] === '') {
			$_SESSION['errorMessage'] ='Username, email and password are required.';
		} elseif (false) {
			// do some validation on email
		} elseif ($userInputData['rawPassword'] !== $userInputData['repeatedRawPassword']){
			$_SESSION['errorMessage'] = 'Passwords do not match.';
		} else {
			$userModel = $this->container->get('userModel');
			$hashPassword = password_hash($userInputData['rawPassword'], PASSWORD_DEFAULT);
			$errorData = $userModel->insertNewUser($userInputData['username'], $userInputData['email'], $hashPassword);
			$errorLogger = $this->container->get('errorLoggerModel');
			$errorLogger->logTestJSON($errorData);
			if ($errorData) {
				$errorLogger = $this->container->get('errorLoggerModel');
				$errorLogger->logDatabaseError($errorData['cause'], $errorData['exception']);
				$_SESSION['error'] = true;
				$_SESSION['errorMessage'] = 'Username is already taken.';
			} else {
				$userData = $userModel->getUserByName($userInputData['username']);
				if (isset($userData['exception'])) {
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
		}
		return $response->withStatus(500)->withHeader('Location', './signup');
	}
}