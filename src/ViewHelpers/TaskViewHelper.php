<?php

namespace App\ViewHelpers;

use App\Abstracts\TaskEntityAbstract;

class TaskViewHelper
{
	public static function createTaskListing(TaskEntityAbstract $task): string
	{
		if ($task->isDeleted()) {
			$taskTime = $task->getDeletionTime();
			$taskTimePrefix = 'Deleted:';
			$taskStyle = 'deleted';
			$buttonOneName = 'Restore';
			$buttonOneFormAction = '/recover';
			$buttonOneStyle = 'success';
			$buttonTwoName = 'Delete Permanently';
			$buttonTwoFormAction = '/deletePermanently';
		} elseif ($task->isComplete()) {
			$taskTime = $task->getCompletionTime();
			$taskTimePrefix = 'Completed:';
			$taskStyle = 'complete';
			$buttonOneName = 'Mark Incomplete';
			$buttonOneStyle = 'primary';
			$buttonOneFormAction = '/incomplete';
			$buttonTwoName = 'Delete';
			$buttonTwoFormAction = '/delete';
		} else {
			$taskTime = $task->getCreationTime();
			$taskTimePrefix = 'Created:';
			$taskStyle = 'incomplete';
			$buttonOneName = 'Complete';
			$buttonOneStyle = 'success';
			$buttonOneFormAction = '/complete';
			$buttonTwoName = 'Delete';
			$buttonTwoFormAction = '/delete';
		}

		return
			'<div class="card task ' . $taskStyle . ' col-10 p-2">' .
				'<div class="card-body col-8">' .
					'<h5 class="card-title">' . $task->getTitle() .'</h5>' .
				'</div>' .
				'<div class="card-body col-12">' .
					'<span class="card-text">' .$task->getText() .'</span>' .
				'</div>' .
				'<div class="card-body col-12">' .
					'<span class="card-text text-nowrap">' . $taskTimePrefix . ' ' . $taskTime .'</span>' .
				'</div>' .
				'<div class="card-body d-flex justify-content-end">' .
					'<form class="d-flex flex-row-nowrap" method="post">' .
						'<input type="hidden" name="task' . $task->getID() . '">' .
						'<button type="submit" formaction="' . $buttonOneFormAction . '" class="btn btn-' .$buttonOneStyle . ' text-nowrap">' . $buttonOneName . '</button>' .
						'<button type="submit" formaction="' .$buttonTwoFormAction . '" class="btn btn-danger">' . $buttonTwoName .'</button>' .
					'</form>' .
				'</div>' .
			'</div>';
	}
}
