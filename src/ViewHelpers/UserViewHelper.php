<?php

namespace App\ViewHelpers;
use App\Abstracts\UserEntityAbstract;
use App\Entities\UserEntity;

class UserViewHelper
{
	public static function createUserProfileCard(UserEntityAbstract $user): string
	{
		return
			'<h2 class="card-title">' . $user->getUserName() . '</h2>' .
			'<form mehtod="post" action="logout"><input type="submit" value="Logout"></form>';
	}
}