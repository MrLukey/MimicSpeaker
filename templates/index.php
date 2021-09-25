<?php

use App\ViewHelpers\TaskViewHelper;

$incompleteTasks = [];
$completeTasks = [];
$deletedTasks = [];

if ($data === []) {
	$errorMessage = 'You have no tasks on your todo list.';
} elseif (isset($data['exception'])) {
    $errorMessage = 'Unexpected error';
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
    <link type="text/css" rel="stylesheet" href="/css/taskStyling.css">
    <title>Completed Tasks</title>
</head>
<body>
<main class="taskContainer">
    <form class="newTaskForm" method="post" action="add">
        <input class="newTaskText" type="text" name="taskText" placeholder="Enter new task...">
        <input class="newTaskButton" type="submit" value="Add">
    </form>
    <p class="errorMessage"><?php echo $errorMessage ?></p>
    <div class="taskContainer incompleteTasksContainer">
        <?php foreach ($incompleteTasks as $task) {
            echo TaskViewHelper::createIncompleteTaskListing($task);
        }?>
    </div>
    <div class="taskContainer completedTasksContainer">
		<?php foreach ($completeTasks as $task) {
			echo TaskViewHelper::createCompletedTaskListing($task);
		}?>
    </div>
    <div class="taskContainer deletedTasksContainer">
		<?php foreach ($deletedTasks as $task) {
			echo TaskViewHelper::createDeletedTaskListing($task);
		}?>
    </div>
</main>
</body>
</html>
