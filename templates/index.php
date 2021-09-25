<?php

use App\ViewHelpers\TaskViewHelper;

?>

<!DOCTYPE html>
<html lang="en-gb">
<head>
    <meta charset="utf-8"/>
    <link type="text/css" rel="stylesheet" href="/css/taskStyling.css">
    <title>Completed Tasks</title>
</head>
<body>
<main>
    <form method="post" action="add">
        <input type="text" name="taskText" placeholder="Enter new task...">
        <input type="submit" value="Add">
    </form>
		<?php
		if ($data === []){
			echo 'You have no tasks on your todo list.';
		} elseif (!isset($data['exception'])){
			foreach($data as $task) {
				if ($task->isDeleted()){
				    echo TaskViewHelper::createDeletedTaskListing($task);
                } elseif ($task->getDeletedAt() !== 'N/A'){
				    echo TaskViewHelper::createRecoveredTaskListing($task);
                } elseif ($task->isComplete()){
				    echo TaskViewHelper::createCompletedTaskListing($task);
                } else {
				    echo TaskViewHelper::createIncompleteTaskListing($task);
                }
			}
		} ?>
<!--        <input type="submit" name="editFunction" value="Complete">-->
<!--        <input type="submit" name="editFunction" value="Delete">-->
<!--        <input type="submit" name="editFunction" value="Recover">-->
</main>
</body>
</html>
