<?php
declare(strict_types=1);

use Slim\App;

return function (App $app) {
    $app->get('/', 'toDoListPageController');

    $app->get('/login', 'loginPageController');
    $app->post('/login', 'authenticateUserController');

	$app->any('/signUp', 'insertNewUserController');
    $app->any('/add', 'insertNewTaskController');
    $app->any('/complete', 'markTasksCompleteController');
    $app->any('/incomplete', 'markTasksIncompleteController');
    $app->any('/archive', 'markTasksArchivedController');
    $app->any('/recover', 'markTasksNotArchivedController');
    $app->any('/deletePermanently', 'deleteTasksPermanentlyController');

	$app->post('/editAll', 'editAllTasksController');
};
