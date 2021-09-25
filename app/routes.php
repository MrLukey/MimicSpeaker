<?php
declare(strict_types=1);

use Slim\App;

return function (App $app) {
    $app->get('/', 'allTasksController');
    $app->post('/edit', 'editTasksController');
    $app->post('/add', 'insertTaskController');
    $app->post('/complete', 'markTaskCompleteController');
    $app->post('/incomplete', 'markTaskIncompleteController');
    $app->post('/delete', 'markTaskDeletedController');
    $app->post('/recover', 'markTaskNotDeletedController');
};
