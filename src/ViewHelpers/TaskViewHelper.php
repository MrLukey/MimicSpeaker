<?php

namespace App\ViewHelpers;

use App\Abstracts\TaskEntityAbstract;

class TaskViewHelper
{
	public static function createIncompleteTaskListing(TaskEntityAbstract $task): string
	{
		return '<div class="task incomplete"><p class="taskText">' . $task->getText() .'</p>' .
			'<p class="dateTime">Created: ' . $task->getCreatedAt() .'</p>' .
			'<form action="/complete" method="post"><input type="hidden" name="task' . $task->getID() .
			'"><input type="submit" value="Complete"></form></div>';
	}

	public static function createCompletedTaskListing(TaskEntityAbstract $task): string
	{
		return '<div class="task completed" id="task' . $task->getID() . '">' .
			'<input type="checkbox" name="task' . $task->getID() .'">' .
			'<p class="taskText">' . $task->getText() . '</p>' .
			'<p class="dateTime">Completed: ' . $task->getCompletedAt() .'</p>' .
			'</div>';
	}

	public static function createDeletedTaskListing(TaskEntityAbstract $task): string
	{
		return '<div class="task deleted" id="task' . $task->getID() . '">' .
			'<input type="checkbox" name="task' . $task->getID() .'">' .
			'<p class="taskText">' . $task->getText() . '</p>' .
			'<p class="dateTime">Deleted: ' . $task->getDeletedAt() .'</p>' .
			'</div>';
	}

	public static function createRecoveredTaskListing(TaskEntityAbstract $task) : string
	{
		return '<div class="task recovered" id="task' . $task->getID() . '">' .
			'<input type="checkbox" name="task' . $task->getID() .'">' .
			'<p class="taskText">' . $task->getText() . '</p>' .
			'<p class="dateTime">Deleted: ' . $task->getDeletedAt() .'</p>' .
			'</div>';
	}
}
