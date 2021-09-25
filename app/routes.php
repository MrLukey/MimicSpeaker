<?php
declare(strict_types=1);

use Slim\App;

return function (App $app) {

    $app->get('/', 'allTasksController');
    $app->post('/edit', 'editTasksController');
    $app->post('/add', 'insertTaskController');
};
