<?php

namespace App\Controllers\DatabaseControllers;
use Psr\Container\ContainerInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class LoginUserController
{
	private ContainerInterface $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	public function __invoke(Request $request, Response $response, array $args)
	{
		$_SESSION['loggedIn'] = false;
		$_SESSION['user'] = null;
		$_SESSION['error'] = true;
		$_SESSION['errorMessage'] = 'Username and password are incorrect.';
		$userInputData = $request->getParsedBody();
		if ($userInputData['username'] === '' || $userInputData['rawPassword'] === '')
			$_SESSION['errorMessage'] = 'Username and password must be supplied.';
		else {
			$userModel = $this->container->get('userModel');
			$hashPasswordData = $userModel->getHashedPasswordForUser($userInputData['username']);
			if (isset($hashPasswordData['exception'])){
				$errorLogger = $this->container->get('errorLoggerModel');
				$errorLogger->logDataBaseError($hashPasswordData['cause'], $hashPasswordData['exception']);
				$_SESSION['errorMessage'] = 'Unexpected database error.';
			} elseif ($hashPasswordData) {
				$hashPassword = $hashPasswordData[0]['password'];
				$userData = $userModel->getUserByName($userInputData['username']);
				if (isset($userData['exception'])) {
					$errorLogger = $this->container->get('errorLoggerModel');
					$errorLogger->logDatabaseError($userData['cause'], $userData['exception']);
					$_SESSION['error'] = 'Unexpected database error.';
				} elseif (password_verify($userInputData['rawPassword'], $hashPassword)){
					$_SESSION['loggedIn'] = true;
					$_SESSION['loginAttempts'] = 0;
					$_SESSION['user'] = $userData[0];
					$_SESSION['error'] = false;
					$_SESSION['errorMessage'] = '';
					return $response->withStatus(200)->withHeader('Location', './');
				} else {
					$_SESSION['loginAttempts']++;
					if ($_SESSION['loginAttempts'] > 10) {
						$errorLogger = $this->container->get('errorLoggerModel');
						$suspectLoginData = ['type' => 'Login Attempts',
							'# of attempts' => $_SESSION['loginAttempts'],
							'onUser' => $userData[0]];
						$errorLogger->logSuspiciousActivity($suspectLoginData);
					}
				}
			}
		}
		return $response->withStatus(500)->withHeader('Location', './login');
	}
}