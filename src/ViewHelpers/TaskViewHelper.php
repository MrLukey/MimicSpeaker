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
		return '<div class="task complete"><p class="taskText">' . $task->getText() .'</p>' .
			'<p class="dateTime">Completed: ' . $task->getCompletedAt() .'</p>' .
			'<form action="/incomplete" method="post"><input type="hidden" name="task' . $task->getID() . '"><input type="submit" value="Mark Incomplete"></form>' .
			'<form action="/delete" method="post"><input type="hidden" name="task' . $task->getID() . '"><input type="submit" value="Delete"></form></div>';
	}

	public static function createDeletedTaskListing(TaskEntityAbstract $task): string
	{
		return '<div class="task deleted"><p class="taskText">' . $task->getText() .'</p>' .
			'<p class="dateTime">Deleted: ' . $task->getDeletedAt() .'</p>' .
			'<form action="/recover" method="post"><input type="hidden" name="task' . $task->getID() . '"><input type="submit" value="Restore"></form></div>';
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