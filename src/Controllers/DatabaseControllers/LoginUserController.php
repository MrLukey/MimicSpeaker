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
			$user = $userModel->getUserByName($userInputData['username']);
			if ($user){
				$hashPassword = $userModel->getHashedPasswordForUser($user->getID());
				if ($hashPassword){
					$activityLogger = $this->container->get('activityLoggerModel');
					if (password_verify($userInputData['rawPassword'], $hashPassword)){
						$activityLogger->logSuccessfulLogin($user->getID());
						$_SESSION['loggedIn'] = true;
						$_SESSION['user'] = $user;
						$_SESSION['error'] = false;
						$_SESSION['errorMessage'] = '';
						return $response->withStatus(200)->withHeader('Location', './');
					}
					$activityLogger->logUnsuccessfullLogin($user->getID());
				}
			}
		}
		return $response->withStatus(500)->withHeader('Location', './login');
	}
}