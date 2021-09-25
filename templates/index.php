<!DOCTYPE html>
<html lang="en-gb">
<head>
    <meta charset="utf-8"/>
    <link type="text/css" rel="stylesheet" href="/css/taskStyling.css">
    <title>Completed Tasks</title>
</head>
<body>
<main>
    <form class="toDoList" method="post" action="delete">
		<?php
		if ($data === []){
			echo 'You have no tasks on your todo list.';
		} elseif (!isset($data['exception'])){
			foreach($data as $task) {
				echo '<div class="task"><input type="checkbox" name="task' . $task['id'] . '"><p>' . $task['text']
					. '</p><p>' . $task['createdAt'] . '</p><p>' . $task['completedAt'] . '</p></div>';
			}
		} ?>
        <input type="submit" value="Delete">
    </form>
</main>
</body>
</html>
