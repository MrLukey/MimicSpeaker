<?php

namespace App\ViewHelpers;

class MimicViewHelper
{
	public static function createHTMLForMimic(array $mimic): string
	{
		$mimicHTML = '';
		foreach ($mimic as $word){
			$mimicHTML .= '<button>' . $word . '</button>';
		}
		return $mimicHTML;
	}

	public static function createHTMLForMimicSpeakerBuilder(array $processedTexts): string
	{
		$customSelector =
			'<label for="buildSelect">Pick Build:</label>
			<select name="buildSelect" id="buildSelect">
				<option value="preBuilt">Pre-built</option>
				<option value="customBuild">Build from text file</option>
			</select>';

		$customBuilder =
			'<label for="inputFile">Upload text file for processing</label>
			<input type="file" class="form-control-file" name="inputFile" id="inputFile">';

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
		$buildButton = '<input type="submit" value="Build Mimic Speaker">';
		return '<form action="buildMimicSpeaker" method="post" enctype="multipart/form-data">' . $customSelector . $customBuilder . $titleSelector . $genreSelector . $buildButton . '</form>';
	}

	public static function createHTMLForMimicSpeaker(){
		$sentenceLength = '<input type="number" min="5" value=50 name="sentenceLength">';
		$mimicButton = '<input type="submit" value="Mimic">';
		return '<form action="mimic" method="post">' . $sentenceLength . $mimicButton . '</form>';
	}
}