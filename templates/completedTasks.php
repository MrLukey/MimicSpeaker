<!DOCTYPE html>
<html lang="en-gb">
<head>
	<meta charset="utf-8"/>
	<link type="text/css" rel="stylesheet" href="/css/taskStyling.css">
	<title>Completed Tasks</title>
</head>
<body>
<main>
	<div class="toDoList">
		<?php
        if ($data === []){
            echo 'There are no completed tasks';
        } else {
            foreach($data as $task) {
	            echo '<div class="task"><p>' . $task['text'] . '</p><p>' . $task['createdAt'] . '</p></div>';
            }
		} ?>
	</div>
</main>
</body>
</html>