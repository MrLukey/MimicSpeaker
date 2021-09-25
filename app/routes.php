<?php
declare(strict_types=1);

use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/', 'allTasksController');

	$app->get('/incomplete', 'incompleteTasksController');
	$app->post('/incomplete', 'insertTaskController');

	$app->get('/complete', 'completedTasksController');
	$app->post('/complete', 'markTaskCompleteController');

	$app->get('/delete', 'deletedTasksController');
	$app->post('/delete', 'markTaskDeletedController');

	$app->post('/recover', 'recoverDeletedTaskController');

};
