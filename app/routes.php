<?php
declare(strict_types=1);

use Slim\App;

return function (App $app) {
    $app->get('/', 'homePageController');
    $app->get('/admin', 'adminPageController');

    $app->get('/login', 'loginPageController');
    $app->post('/login', 'loginUserController');
    $app->get('/signup', 'signUpPageController');
	$app->post('/signup', 'signUpNewUserController');
    $app->any('/logout', 'logoutUserController');

    $app->post('/buildMimicSpeaker', 'buildMimicSpeakerController');
    $app->post('/mimic', 'mimicController');
    $app->post('/publishMimic', 'publishMimicController');


    $app->post('/add', 'insertNewTaskController');
    $app->post('/complete', 'markTasksCompleteController');
    $app->post('/incomplete', 'markTasksIncompleteController');
    $app->post('/archive', 'markTasksArchivedController');
    $app->post('/recover', 'markTasksNotArchivedController');
    $app->post('/delete', 'deleteTasksController');
	$app->post('/editAll', 'editAllTasksController');

	$app->any('/{path:.*}', 'loginPageController');
};
