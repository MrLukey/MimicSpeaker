<?php

use App\ViewHelpers\TaskViewHelper;
use App\ViewHelpers\UserViewHelper;

$incompleteTasks = [];
$completeTasks = [];
$archivedTasks = [];

if (!$_SESSION['error'] && $data === [])
	$_SESSION['errorMessage'] = 'You have no tasks on your todo list.';
else {
	foreach ($data as $task) {
		if ($task->isArchived())
			array_push($archivedTasks, $task);
		elseif ($task->isComplete())
			array_push($completeTasks, $task);
		else
			array_push($incompleteTasks, $task);
	}
}
?>
<!DOCTYPE html>
<html lang="en-gb">
<head>
    <meta charset="utf-8"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU"
          crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="/css/taskStyling.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
            crossorigin="anonymous"></script>
    <title>Slim ToDo App</title>
</head>
<body>
    <header>
        <div class="row d-flex justify-content-center m-auto">
		    <?php echo UserViewHelper::createHTMLForUserProfileCard($_SESSION['user']); ?>
        </div>
        <nav class="row d-flex row-wrap justify-content-between align-items-baseline w-100 p-3">
            <?php echo TaskViewHelper::createHTMLForNewTaskForm()  ?>
        </nav>
    </header>
<main class="d-flex flex-row align-items-start w-75 m-auto">
    <p class="errorMessage"><?php echo $_SESSION['errorMessage'] ?></p>
    <?php
        if(count($incompleteTasks) > 0) {
            echo '<section class="col-12 col-md-4 mb-5">';
            foreach ($incompleteTasks as $task)
                echo TaskViewHelper::createHTMLForTaskCard($task);
            echo '</section>';
        }
        if(count($completeTasks) > 0) {
            echo '<section class="col-12 col-md-4 mb-5">';
            foreach ($completeTasks as $task)
                echo TaskViewHelper::createHTMLForTaskCard($task);
            echo '</section>';
        }
        if(count($archivedTasks) > 0) {
            echo '<section class="col-12 col-md-4 mb-5">';
            foreach ($archivedTasks as $task)
                echo TaskViewHelper::createHTMLForTaskCard($task);
            echo '</section>';
	    }
    ?>
</main>
</body>
</html>

<?php
$_SESSION['error'] = false;
$_SESSION['errorMessage'] = '';
