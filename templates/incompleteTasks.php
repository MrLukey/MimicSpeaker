<!DOCTYPE html>
<html lang="en-gb">
<head>
	<meta charset="utf-8"/>
	<link type="text/css" rel="stylesheet" href="/css/taskStyling.css">
	<title>Incomplete Tasks</title>
</head>
<body>
<main>
    <form action="incomplete" method="post">
        <input type="text" name="taskText" placeholder="Enter new task...">
        <input type="submit" value="Add">
    </form>
	<form class="toDoList" method="post" action="complete">
		<?php
        if ($data === []){
            echo 'There are no incomplete tasks';
        } elseif (!isset($data['exception'])) {
	        foreach($data as $task) {
		        echo '<div class="task"><input type="checkbox" name="task' . $task['id'] . '">' . '<p>' . $task['text'] . '</p><p>' . $task['createdAt'] . '</p></div>';
	        }
        } ?>
        <input type="submit" value="Complete">
	</form>
</main>
</body>
</html>