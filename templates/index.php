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
    <form class="toDoList" method="post" action="edit">
		<?php
		if ($data === []){
			echo 'You have no tasks on your todo list.';
		} elseif (!isset($data['exception'])){
			foreach($data as $task) {
				echo \App\ViewHelpers\TaskViewHelper::createTaskListing($task);
			}
		} ?>
        <input type="submit" name="editFunction" value="Complete">
        <input type="submit" name="editFunction" value="Delete">
        <input type="submit" name="editFunction" value="Recover">
    </form>
</main>
</body>
</html>
