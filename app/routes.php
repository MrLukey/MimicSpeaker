<?php
declare(strict_types=1);

use Slim\App;

return function (App $app) {
    $app->get('/', 'toDoListPageController');

    $app->get('/login', 'loginPageController');
    $app->post('/login', 'loginUserController');

    $app->get('/signup', 'signUpPageController');
	$app->post('/signup', 'signUpNewUserController');

    $app->any('/logout', 'logoutUserController');
    $app->any('/add', 'insertNewTaskController');
    $app->any('/complete', 'markTasksCompleteController');
    $app->any('/incomplete', 'markTasksIncompleteController');
    $app->any('/archive', 'markTasksArchivedController');
    $app->any('/recover', 'markTasksNotArchivedController');
    $app->any('/delete', 'deleteTasksController');

	$app->post('/editAll', 'editAllTasksController');
};
