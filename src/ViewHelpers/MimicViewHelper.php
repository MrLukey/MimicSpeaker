<?php

namespace App\ViewHelpers;

class MimicViewHelper
{
	public static function createHTMLForMimic(array $mimic): string
	{
		return print_r($mimic);
	}

	public static function createHTMLForMimicGenerator(array $processedTexts): string
	{
		$titleSelector =
			'<label for="titleSelect">Title:</label>
			<select name="shortTitle" id="titleSelect">
		   		<option value="">Random</option>';

		$genreSelector =
			'<label for="genreSelect">Genre:</label>
			<select name="genre" id="genreSelect">
		   		<option value="">Random</option>';

		$uniqueGenres = [];
		foreach ($processedTexts as $text){
			$titleSelector .= '<option value="' . $text['short_title'] . '">' . $text['full_title'] . '</option>';
			if (!in_array($text['genre'], $uniqueGenres)){
				$uniqueGenres[] = $text['genre'];
				$genreSelector .= '<option value="' . $text['genre'] . '">' . $text['genre'] . '</option>';
			}
		}
		$titleSelector .= '</select>';
		$genreSelector .= '</select>';
		$editButton = '<input type="submit" value="Mimic">';
		return '<form action="mimicSpeaker" method="post">' . $titleSelector . $genreSelector . $editButton . '</form>';
	}
}