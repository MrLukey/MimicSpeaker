<?php

namespace App\ViewHelpers;
use App\Abstracts\TaskEntityAbstract;

class TaskViewHelper
{
	public static function createHTMLForNewTaskForm(): string
	{
		return
			'<form method="post" action="add">
				<div class="input-group mb-3">
					<label class="input-group-text" for="title">To Do</label>
					<input type="text" maxlength="100" class="form-control" name="taskTitle" id="title" placeholder="e.g Walk the dog">
				</div>
				<div class="input-group">
					<label class="input-group-text" for="text">Extra Info</label>
					<textarea class="form-control" name="taskText" id="text" aria-label="With textarea"></textarea>
					<button class="btn btn-primary" type="submit">Add</button>
				</div>
			</form>';
	}

	public static function createHTMLForTaskCard(TaskEntityAbstract $task): string
	{
		if ($task->isArchived()) {
			$taskTime = $task->getArchivedTime();
			$taskBG = 'bg-danger';
			$taskStyle = 'Archived';
			$buttonOneName = 'Recover';
			$buttonOneFormAction = '/recover';
			$buttonOneStyle = 'success';
			$buttonTwoName = 'Delete';
			$buttonTwoFormAction = '/delete';
			$buttonTwoStyle = 'danger';
		} elseif ($task->isComplete()) {
			$taskTime = $task->getCompletionTime();
			$taskBG = 'bg-success';
			$taskStyle = 'Complete';
			$buttonOneName = 'Incomplete';
			$buttonOneStyle = 'warning';
			$buttonOneFormAction = '/incomplete';
			$buttonTwoName = 'Archive';
			$buttonTwoFormAction = '/archive';
			$buttonTwoStyle = 'secondary';
		} else {
			$taskTime = $task->getCreationTime();
			$taskBG = 'bg-warning';
			$taskStyle = 'Incomplete';
			$buttonOneName = 'Complete';
			$buttonOneStyle = 'success';
			$buttonOneFormAction = '/complete';
			$buttonTwoName = 'Archive';
			$buttonTwoFormAction = '/archive';
			$buttonTwoStyle = 'secondary';
		}
		$textDiv = '<p class="card-text">' .$task->getText() .'</p>';
		$textDiv = $task->getText() !== '' ? $textDiv : '';
		return
			'<div class="card task w-100 mb-3">' .
				'<div class="card-header ' . $taskBG . '">' . $taskStyle . '</div>' .
				'<div class="card-body">' .
					'<h5 class="card-title">' . $task->getTitle() .'</h5>' .
					$textDiv .
					'<form method="post">' .
						'<input type="hidden" name="task' . $task->getID() . '">' .
						'<div class="btn-group" role="group">' .
							'<button type="submit" formaction="' . $buttonOneFormAction . '" class="btn btn-sm btn-' .
								$buttonOneStyle . '">' . $buttonOneName . '</button>' .
							'<button type="submit" formaction="' .$buttonTwoFormAction . '" class="btn btn-sm btn-' .
								$buttonTwoStyle . '">' . $buttonTwoName .'</button>' .
						'</div>' .
					'</form>' .
				'</div>' .
				'<div class="card-footer">@' . $taskTime . '</div>' .
			'</div>';
	}
}
