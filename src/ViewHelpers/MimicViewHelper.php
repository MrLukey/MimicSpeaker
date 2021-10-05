<?php

namespace App\ViewHelpers;

class MimicViewHelper
{
	public static function createHTMLForMimic(array $mimic): string
	{
		return print_r($mimic);
	}
}