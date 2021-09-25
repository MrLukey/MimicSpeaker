<?php

namespace App\ViewHelpers;

use App\Abstracts\TaskEntityAbstract;

class TaskViewHelper
{
	public static function createTaskListing(TaskEntityAbstract $task): string
	{
		return '<div class="task"><input type="checkbox" name="task' . $task->getID() . '"><p>' . $task->getText()
			. '</p><p>' . $task->getCreatedAt() . '</p><p>' . $task->getCompletedAt() . '</p></div>';
	}
}