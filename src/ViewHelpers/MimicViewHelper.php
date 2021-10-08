<?php

namespace App\ViewHelpers;

class MimicViewHelper
{
	public static function createHTMLForMimic(array $mimic): string
	{
		$mimicHTML =
			'<div class="container col-10 d-flex row-wrap">
				<div class="card rounded-3">
					<div class="card-body">
						<div class="">';
							foreach ($mimic as $index => $word){
								$mimicHTML .=
									'<div class="wordWrapper m-1">
										<button class="wordButton btn btn-outline-dark btn-md"
												id="wordButton' . $index . '"
												data-edited="false"
												data-id="' . $index . '">' . $word . '</button>' .
										MimicViewHelper::createHTMLForEditingButtons($index) .
									'</div>';
							}
		$mimicHTML .=   '</div>
					</div>
				</div>
			</div>';
		return $mimicHTML;
	}

	private static function createHTMLForEditingButtons(int $wordID): string
	{
		return
			'<div class="editButtons bg-secondary rounded-3 d-none p-1" role="" id="editButtons' . $wordID . '" data-id="' . $wordID .'">
				<div class="btn-group" role="group">
					<button class="clearButton btn btn-sm btn-secondary" data-id="' . $wordID .'"> </button>
					<button class="commaButton btn btn-sm btn-secondary" data-id="' . $wordID .'">,</button>
					<button class="fullStopButton btn btn-sm btn-secondary" data-id="' . $wordID .'">.</button>
					<button class="semicolonButton btn btn-sm btn-secondary" data-id="' . $wordID .'">;</button>
					<button class="colonButton btn btn-sm btn-secondary" data-id="' . $wordID .'">:</button>
					<button class="exclamationButton btn btn-sm btn-secondary" data-id="' . $wordID .'">!</button>
					<button class="questionButton btn btn-sm btn-secondary" data-id="' . $wordID .'">?</button>
				</div>
				<div class="btn-group" role="group">
					<button class="allLowerButton btn btn-sm btn-secondary" data-id="' . $wordID .'">aaa</button>
					<button class="firstCapsButton btn btn-sm btn-secondary" data-id="' . $wordID .'">Aaa</button>
					<button class="allCapsButton btn btn-sm btn-secondary" data-id="' . $wordID .'">AAA</button>
					<button class="deleteButton btn btn-sm btn-secondary" data-id="' . $wordID .'">Delete</button>
				</div>
			</div>';
	}

	public static function createHTMLForMimicSpeakerBuilder(array $processedTexts): string
	{
		$buildSelector =
			'<div class="form-group">
				<label for="buildSelect">Pick Build:</label>
				<select name="buildSelect" id="buildSelect">
					<option value="preBuilt">Pre-built</option>
					<option value="customBuild">Build from text file</option>
				</select>
			</div>';

		$textFileInput =
			'<div class="form-group">
				<label for="inputFile">Upload text file for processing</label>
				<input type="file" class="form-control-file" name="inputFile" id="inputFile">
			</div>';

		$titleSelector =
			'<div class="form-group">
				<label for="titleSelect">Title:</label>
				<select name="shortTitle" id="titleSelect">
			        <option value="">Random</option>';

		$genreSelector =
			'<div class="form-group">
				<label for="genreSelect">Genre:</label>
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
		$titleSelector .= '</select></div>';
		$genreSelector .= '</select></div>';
		$buildButton = '<input type="submit" value="Build Mimic Speaker">';
		return
			'<div class="card rounded-3">' .
				'<div class="card-body">' .
					'<form action="buildMimicSpeaker" method="post" enctype="multipart/form-data">' .
						$buildSelector .
						'<div class="userInpiut">' .
							$textFileInput .
						'</div>' .
						'<div class="userInpiut">' .
							$titleSelector .
							$genreSelector .
						'</div>' .
							$buildButton .
					'</form>' .
				'</div>' .
			'</div>';
	}

	public static function createHTMLForMimicSpeaker(): string
	{
		return
			'<div class="card rounded-3">
				<form action="mimic" method="post">
					<input type="number" min="5" value=50 name="sentenceLength">
					<input type="submit" value="Mimic">
				</form>
			</div>';
	}
}