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
		if ($userData['userName'] === '' || $userData['rawPassword'] === '')
			return $response->withStatus(500)->withHeader('Location', './login');
		$hashPasswordData = $userModel->getHashedPassword($userData['userName']);
		if (isset($hashPasswordData['exception'])) {
			$errorLogger->logDataBaseError($hashPasswordData['cause'], $hashPasswordData['exception']);
		} else {
			if (password_verify($userData['rawPassword'], $hashPasswordData['hashPassword'])){
				$_SESSION['loggedIn'] = true;
				$errorLogger->logTestString('VERIFIED');
				return $response->withStatus(200)->withHeader('Location', './');
			} else {
				$errorLogger->logTestString('UNVERIFIED');
				$_SESSION['loggedIn'] = false;
			}
		}
		return $response->withStatus(200)->withHeader('Location', './login');
	}
}