<?php

namespace App\ViewHelpers;
use App\Abstracts\UserEntityAbstract;

class UserViewHelper
{
	public static function createHTMLForUserProfileCard(UserEntityAbstract $user): string
	{
		return
			'<div class="d-flex row-nowrap align-items-baseline justify-content-between p-3">' .
				'<span class="userName">' . $user->getUserName() . '</span>' .
				'<form mehtod="post" action="logout"><input class="btn btn-secondary" type="submit" value="Logout"></form>' .
			'</div>';
	}
}