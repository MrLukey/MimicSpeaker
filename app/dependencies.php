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

	$container['mimicSpeakerController'] = DI\factory('App\Factories\DatabaseFactories\MimicSpeakerControllerFactory');


	$container['taskModel'] = DI\factory('App\Factories\ModelFactories\TaskModelFactory');
	$container['toDoListPageController'] = DI\factory('App\Factories\PageFactories\ToDoListPageControllerFactory');
	$container['insertNewTaskController'] = DI\factory('App\Factories\DatabaseFactories\InsertNewTaskControllerFactory');
	$container['editAllTasksController'] = DI\factory('App\Factories\DatabaseFactories\EditAllTasksControllerFactory');
	$container['markTasksCompleteController'] = DI\factory('App\Factories\DatabaseFactories\MarkTasksCompleteControllerFactory');
	$container['markTasksIncompleteController'] = DI\factory('App\Factories\DatabaseFactories\MarkTasksIncompleteControllerFactory');
	$container['markTasksArchivedController'] = DI\factory('App\Factories\DatabaseFactories\MarkTasksArchivedControllerFactory');
	$container['markTasksNotArchivedController'] = DI\factory('App\Factories\DatabaseFactories\MarkTasksNotArchivedControllerFactory');
	$container['deleteTasksController'] = DI\factory('App\Factories\DatabaseFactories\deleteTasksControllerFactory');

    $containerBuilder->addDefinitions($container);
};
