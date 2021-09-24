<!DOCTYPE html>
<html lang="en-gb">
<head>
	<meta charset="utf-8"/>
	<link type="text/css" rel="stylesheet" href="/css/taskStyling.css">
	<title>Incomplete Tasks</title>
</head>
<body>
<main>
	<div class="taskContainer">
		<?php foreach($data as $task){
		    echo '<div class="task"><input type="checkbox" name="task' . $task['id'] . '">' . '<p>' . $task['text'] . '</p><p>' . $task['createdAt'] . '</p></div>';
			} ?>
	</div>
</main>
</body>
</html>