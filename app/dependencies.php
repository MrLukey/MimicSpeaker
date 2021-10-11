<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Slim\Views\PhpRenderer;

return function (ContainerBuilder $containerBuilder) {
    $container = [];

    $container[LoggerInterface::class] = function (ContainerInterface $c) {
        $settings = $c->get('settings');

        $loggerSettings = $settings['logger'];
        $logger = new Logger($loggerSettings['name']);

        $processor = new UidProcessor();
        $logger->pushProcessor($processor);

        $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
        $logger->pushHandler($handler);

        return $logger;
    };

    $container['renderer'] = function (ContainerInterface $c) {
        $settings = $c->get('settings')['renderer'];
        return new PhpRenderer($settings['template_path']);
    };

    $container['pdo'] = DI\factory('App\Factories\BuiltInClassFactories\PDOFactory');
    $container['dateTime'] = DI\factory('App\Factories\BuiltInClassFactories\DateTimeFactory');
    $container['mimicSpeakerEntity'] = DI\factory('App\Factories\EntityFactories\MimicSpeakerEntityFactory');

	$container['userModel'] = DI\factory('App\Factories\ModelFactories\UserModelFactory');
	$container['errorLoggerModel'] = DI\factory('App\Factories\ModelFactories\ErrorLoggerModelFactory');
	$container['activityLoggerModel'] = DI\factory('App\Factories\ModelFactories\ActivityLoggerModelFactory');
	$container['mimicSpeakerModel'] = DI\factory('App\Factories\ModelFactories\MimicSpeakerModelFactory');

    $container['loginPageController'] = DI\factory('App\Factories\PageFactories\LoginPageControllerFactory');
    $container['signUpPageController'] = DI\factory('App\Factories\PageFactories\SignUpPageControllerFactory');
	$container['homePageController'] = DI\factory('App\Factories\PageFactories\HomePageControllerFactory');

	$container['signUpNewUserController'] = DI\factory('App\Factories\DatabaseFactories\SignUpNewUserControllerFactory');
	$container['loginUserController'] = DI\factory('App\Factories\DatabaseFactories\LoginUserControllerFactory');
	$container['logoutUserController'] = DI\factory('App\Factories\DatabaseFactories\LogoutUserControllerFactory');

	$container['buildMimicSpeakerController'] = DI\factory('App\Factories\MimicSpeakerFactories\BuildMimicSpeakerControllerFactory');
	$container['mimicController'] = DI\factory('App\Factories\MimicSpeakerFactories\MimicControllerFactory');
	$container['publishMimicController'] = DI\factory('App\Factories\MimicSpeakerFactories\PublishMimicControllerFactory');

	$container['adminPageController'] = DI\factory('App\Factories\PageFactories\AdminPageControllerFactory');

    $containerBuilder->addDefinitions($container);
};
