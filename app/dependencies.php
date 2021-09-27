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

    $container['loginPageController'] = DI\factory('App\Factories\PageFactories\LoginPageControllerFactory');
	$container['toDoListPageController'] = DI\factory('App\Factories\PageFactories\ToDoListPageControllerFactory');

	$container['taskModel'] = DI\factory('App\Factories\ModelFactories\TaskModelFactory');
	$container['userModel'] = DI\factory('App\Factories\ModelFactories\UserModelFactory');
	$container['errorLoggerModel'] = DI\factory('App\Factories\ModelFactories\ErrorLoggerModelFactory');

	$container['insertNewUserController'] = DI\factory('App\Factories\DatabaseFactories\InsertNewUserControllerFactory');
	$container['authenticateUserController'] = DI\factory('App\Factories\DatabaseFactories\AuthenticateUserControllerFactory');
	$container['insertNewTaskController'] = DI\factory('App\Factories\DatabaseFactories\InsertNewTaskControllerFactory');

	$container['editAllTasksController'] = DI\factory('App\Factories\DatabaseFactories\EditAllTasksControllerFactory');
	$container['markTasksCompleteController'] = DI\factory('App\Factories\DatabaseFactories\MarkTasksCompleteControllerFactory');
	$container['markTasksIncompleteController'] = DI\factory('App\Factories\DatabaseFactories\MarkTasksIncompleteControllerFactory');
	$container['markTasksArchivedController'] = DI\factory('App\Factories\DatabaseFactories\MarkTasksArchivedControllerFactory');
	$container['markTasksNotArchivedController'] = DI\factory('App\Factories\DatabaseFactories\MarkTasksNotArchivedControllerFactory');
	$container['deleteTasksPermanentlyController'] = DI\factory('App\Factories\DatabaseFactories\DeleteTasksPermanentlyControllerFactory');

    $containerBuilder->addDefinitions($container);
};
