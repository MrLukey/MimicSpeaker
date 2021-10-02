<?php

namespace App\Controllers\DatabaseControllers;
use Psr\Container\ContainerInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class SignUpNewUserController
{
	private ContainerInterface $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	public function __invoke(Request $request, Response $response, array $args)
	{
		$_SESSION['error'] = true;
		$_SESSION['errorMessage'] = 'An unexpected error occurred';
		$userInputData = $request->getParsedBody();
		if ($userInputData['username'] === '' || $userInputData['email'] === '' || $userInputData['rawPassword'] === '') {
			$_SESSION['errorMessage'] ='Username, email and password are required.';
		} elseif (!filter_var($userInputData['email'], FILTER_VALIDATE_EMAIL)) {
			$_SESSION['errorMessage'] = 'Email is not valid.';
		} elseif ($userInputData['rawPassword'] !== $userInputData['repeatedRawPassword']){
			$_SESSION['errorMessage'] = 'Passwords do not match.';
		} else {
			$userModel = $this->container->get('userModel');
			$hashPassword = password_hash($userInputData['rawPassword'], PASSWORD_DEFAULT);
			$success = $userModel->insertNewUser($userInputData['username'], $userInputData['email'], $hashPassword);
			if (!$success){
				$_SESSION['errorMessage'] = 'An account already exists.';
			} else {
				$user = $userModel->getUserByName($userInputData['username']);
				if ($user){
					$userModel->linkActivityTableToUser($user->getID());
					$_SESSION['loggedIn'] = true;
					$_SESSION['user'] = $user;
					$_SESSION['error'] = false;
					$_SESSION['errorMessage'] = '';
					$activityLogger = $this->container->get('activityLoggerModel');
					$activityLogger->logSuccessfulLogin($user->getID());
					return $response->withStatus(200)->withHeader('Location', './');
				}
			}
		}
		return $response->withStatus(500)->withHeader('Location', './signup');
	}
}