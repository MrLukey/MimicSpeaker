<?php
declare(strict_types=1);

use Slim\App;

return function (App $app) {
    $app->get('/', 'getAllTasksController');
    $app->post('/editAll', 'editAllTasksController');
    $app->post('/add', 'insertNewTaskController');
    $app->post('/complete', 'markTasksCompleteController');
    $app->post('/incomplete', 'markTasksIncompleteController');
    $app->post('/archive', 'markTasksArchivedController');
    $app->post('/recover', 'markTasksNotArchivedController');
    $app->post('/deletePermanently', 'deleteTasksPermanentlyController');
};
