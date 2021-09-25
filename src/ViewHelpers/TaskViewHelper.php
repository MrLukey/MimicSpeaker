<?php

namespace App\ViewHelpers;

use App\Abstracts\TaskEntityAbstract;

class TaskViewHelper
{
	public static function createIncompleteTaskListing(TaskEntityAbstract $task): string
	{
		return
			'<div class="task incomplete">' .
				'<p class="taskText">' . $task->getText() .'</p>' .
				'<div class="controlWrapper">' .
					'<p class="dateTime">Created: ' . $task->getCreationTime() .'</p>' .
					'<div class="buttonWrapper">' .
						'<form action="/complete" method="post">' .
							'<input type="hidden" name="task' . $task->getID() . '">' .
							'<input type="submit" value="Complete">' .
						'</form>' .
					'</div>' .
				'</div>' .
			'</div>';
	}

	public static function createCompletedTaskListing(TaskEntityAbstract $task): string
	{
		return
			'<div class="task complete">' .
				'<p class="taskText">' . $task->getText() .'</p>' .
				'<div class="controlWrapper">' .
					'<p class="dateTime">Completed: ' . $task->getCompletionTime() .'</p>' .
					'<div class="buttonWrapper">' .
						'<form action="/incomplete" method="post">' .
							'<input type="hidden" name="task' . $task->getID() . '">' .
							'<input type="submit" value="Mark Incomplete" class="editButton">' .
						'</form>' .
						'<form action="/delete" method="post">' .
							'<input type="hidden" name="task' . $task->getID() . '">' .
							'<input type="submit" value="Delete">' .
						'</form>' .
					'</div>' .
				'</div>' .
			'</div>';
	}

	public static function createDeletedTaskListing(TaskEntityAbstract $task): string
	{
		return
			'<div class="task deleted">' .
				'<p class="taskText">' . $task->getText() .'</p>' .
				'<div class="controlWrapper">' .
					'<p class="dateTime">Deleted: ' . $task->getDeletionTime() .'</p>' .
					'<div class="buttonWrapper">' .
						'<form action="/recover" method="post">' .
							'<input type="hidden" name="task' . $task->getID() . '">' .
							'<input type="submit" value="Restore">' .
						'</form>' .
						'<form action="/deletePermanently" method="post">' .
							'<input type="hidden" name="task' . $task->getID() . '">' .
							'<input type="submit" value="Delete Permanently">' .
						'</form>' .
					'</div>' .
				'</div>' .
			'</div>';
	}
}
