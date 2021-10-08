<?php

namespace App\ViewHelpers;

class MimicViewHelper
{
	public static function createHTMLForMimicEditor(array $mimic, array $processedTexts): string
	{
		$mimicHTML =
			'<div class="container">
				<div class="card rounded-3 align-middle">
					<div class="card-header d-flex row-nowrap justify-content-between align-items-baseline">' .
						MimicViewHelper::createHTMLForMimicSpeakerBuilder($processedTexts) .
					'</div>
					<div class="card-body d-none"></div>
					<div class="card-body" id="mimicSpeech">';
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
		$mimicHTML .=
					'</div>
					<div class="card-footer d-flex row-nowrap justify-content-between">
						<div class="d-flex row-nowrap align-items-baseline">
							<input type="number" min="5" value=50 name="sentenceLength" id="sentenceLengthSelector">
							<button class="btn btn-sm btn-primary" id="mimicButton">Mimic</button>
						</div>
						<button class="btn btn-md btn-outline-success">Publish</button>
					</div>
				</div>
			</div>';
		return $mimicHTML;
	}

	private static function createHTMLForMimicSpeakerBuilder(array $processedTexts): string
	{
		$titleSelector =
			'<select class="form-inline form-select w-50 h-100" name="shortTitle" id="titleSelector">
				<option value="">Random Title</option>';

		$genreSelector =
			'<select class="form-inline form-select w-50" name="genre" id="genreSelector">
				<option value="">Random Genre</option>';

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
		return
			//'<form action="buildMimicSpeaker" method="post">' .
					$titleSelector .
					$genreSelector .
			//'</form>
			'<button class="btn btn-md btn-outline-primary text-nowrap" id="buildMimicSpeaker">Build Mimic Speaker</button>';
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
}