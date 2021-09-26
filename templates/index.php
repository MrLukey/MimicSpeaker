<?php

use App\ViewHelpers\TaskViewHelper;

$incompleteTasks = [];
$completeTasks = [];
$deletedTasks = [];

if ($data === []) {
	$errorMessage = 'You have no tasks on your todo list.';
} elseif (isset($data['exception'])) {
    $errorMessage = 'Unexpected error';
    $data = [];
} else {
    $errorMessage = '';
	foreach ($data as $task) {
		if ($task->isDeleted()) {
			array_push($deletedTasks, $task);
		} elseif ($task->isComplete()) {
			array_push($completeTasks, $task);
		} else {
			array_push($incompleteTasks, $task);
		}
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
<main class="d-flex flex-column justify-content-center align-items-center col-12">
    <?php include 'newTaskForm.html'; ?>
    <p class="errorMessage"><?php echo $errorMessage ?></p>
    <div class="d-flex flex-column align-items-center w-100">
        <?php foreach ($incompleteTasks as $task) {
            echo TaskViewHelper::createTaskListing($task);
        }?>
    </div>
    <div class="d-flex flex-column align-items-center w-100">
		<?php foreach ($completeTasks as $task) {
			echo TaskViewHelper::createTaskListing($task);
		}?>
    </div>
    <div class="d-flex flex-column align-items-center w-100">
		<?php foreach ($deletedTasks as $task) {
			echo TaskViewHelper::createTaskListing($task);
		}?>
    </div>
</main>
</body>
</html>
