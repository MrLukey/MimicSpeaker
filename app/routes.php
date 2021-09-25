<?php
declare(strict_types=1);

use Slim\App;

return function (App $app) {

    $app->get('/', 'allTasksController');
    $app->post('/edit', 'editTasksController');

	$app->get('/incomplete', 'incompleteTasksController');
	$app->post('/incomplete', 'insertTaskController');

	$app->get('/complete', 'completedTasksController');
	$app->post('/complete', 'markTaskCompleteController');

	$app->get('/delete', 'deletedTasksController');
	$app->post('/delete', 'markTaskDeletedController');

	$app->post('/recover', 'recoverDeletedTaskController');

};
