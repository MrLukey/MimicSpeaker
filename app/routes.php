<?php
declare(strict_types=1);

use Slim\App;

return function (App $app) {
    $app->get('/', 'toDoListPageController');
    $app->get('/login', 'loginPageController');

    $app->post('/login', 'authenticateUserController');
	$app->post('/signUp', 'insertNewUserController');

    $app->post('/add', 'insertNewTaskController');
    $app->post('/complete', 'markTasksCompleteController');
    $app->post('/incomplete', 'markTasksIncompleteController');
    $app->post('/archive', 'markTasksArchivedController');
    $app->post('/recover', 'markTasksNotArchivedController');
    $app->post('/deletePermanently', 'deleteTasksPermanentlyController');

	$app->post('/editAll', 'editAllTasksController');
};
