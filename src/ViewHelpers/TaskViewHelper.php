<?php

namespace App\ViewHelpers;

use App\Abstracts\TaskEntityAbstract;

class TaskViewHelper
{
	public static function createTaskListing(TaskEntityAbstract $task): string
	{
		if ($task->isDeleted()) {
			$taskTime = $task->getDeletionTime();
			$taskStyle = 'Deleted';
			$buttonOneName = 'Restore';
			$buttonOneFormAction = '/recover';
			$buttonOneStyle = 'success';
			$buttonTwoName = 'Delete Permanently';
			$buttonTwoFormAction = '/deletePermanently';
			$buttonTwoStyle = 'danger';
		} elseif ($task->isComplete()) {
			$taskTime = $task->getCompletionTime();
			$taskStyle = 'Complete';
			$buttonOneName = 'Mark Incomplete';
			$buttonOneStyle = 'primary';
			$buttonOneFormAction = '/incomplete';
			$buttonTwoName = 'Delete';
			$buttonTwoFormAction = '/delete';
			$buttonTwoStyle = 'warning';
		} else {
			$taskTime = $task->getCreationTime();
			$taskStyle = 'Incomplete';
			$buttonOneName = 'Mark Complete';
			$buttonOneStyle = 'success';
			$buttonOneFormAction = '/complete';
			$buttonTwoName = 'Delete';
			$buttonTwoFormAction = '/delete';
			$buttonTwoStyle = 'warning';
		}
		$textDiv = '<p class="card-text">' .$task->getText() .'</p>';
		$textDiv = $task->getText() !== '' ? $textDiv : '';

		return
			'<div class="card task w-100 mb-3">' .
				'<div class="card-header ' . $taskStyle . '">' . $taskStyle . '</div>' .
				'<div class="card-body">' .
					'<h5 class="card-title">' . $task->getTitle() .'</h5>' .
					$textDiv .
					'<form method="post">' .
						'<input type="hidden" name="task' . $task->getID() . '">' .
						'<div class="btn-group" role="group">' .
							'<button type="submit" formaction="' . $buttonOneFormAction . '" class="btn btn-sm btn-' .$buttonOneStyle . '">' . $buttonOneName . '</button>' .
							'<button type="submit" formaction="' .$buttonTwoFormAction . '" class="btn btn-sm btn-' .$buttonTwoStyle . '">' . $buttonTwoName .'</button>' .
						'</div>' .
					'</form>' .
				'</div>' .
				'<div class="card-footer">@' . $taskTime . '</div>' .
			'</div>';
	}
}
