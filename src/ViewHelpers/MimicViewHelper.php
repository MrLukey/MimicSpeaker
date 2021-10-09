<?php

namespace App\ViewHelpers;

use App\Abstracts\MimicSpeakerEntityAbstract;

class MimicViewHelper
{
	public static function createHTMLForMimicEditor(array $mimic, array $processedTexts, MimicSpeakerEntityAbstract $mimicSpeaker): string
	{
		if (count($mimicSpeaker->getBuiltFromLongTitles()) < 1){
			$buildOptionDisplay = '';
			$buildDisplay = ' d-none';
			$buildButtonText = 'Build Mimic Speaker';
		} else {
			$buildOptionDisplay = ' d-none';
			$buildDisplay = '';
			$buildButtonText = 'Edit Mimic Speaker';
		}
		$mimicEditorHTML =
			'<div class="container h-75">
				<div class="card rounded-3 h-100 align-middle">
					<div class="card-header d-flex row-nowrap justify-content-between align-items-baseline">
						<div class="' . $buildDisplay . '" id="mimicSpeakerBuild"><h4>' . $mimicSpeaker->getBuiltFromLongTitles()[0] . '</h4></div>' .
							MimicViewHelper::createHTMLForMimicSpeakerBuilder(
								$processedTexts, $mimicSpeaker->getBuiltFromLongTitles(), $mimicSpeaker->getBuiltFromGenres(), $buildOptionDisplay) .
						'<button class="btn btn-lg btn-outline-primary text-nowrap m-2" id="buildMimicSpeaker">' . $buildButtonText . '</button>
						</div>
					<div class="card-body d-none d-flex overflow-auto" id="mimicPreview"></div>
					<div class="card-body d-flex overflow-auto" id="wordEditor">
						<div class="w-75 m-auto" id="wordsContainer">';
						foreach ($mimic as $index => $word){
							$mimicEditorHTML .=
							'<div class="wordWrapper m-1">
								<button class="wordButton btn btn-outline-dark btn-md"
										id="wordButton' . $index . '"
										data-edited="false"
										data-id="' . $index . '">' . $word . '</button>' .
								MimicViewHelper::createHTMLForEditingButtons($index) .
							'</div>';
							}
		$mimicEditorHTML .=
						'</div>
					</div>
					<div class="card-footer d-flex row-nowrap justify-content-between">
						<div class="d-flex row-nowrap align-items-baseline">
							<button class="btn btn-lg btn-primary m-2" id="mimicButton">Mimic</button>
							<input class="h-75 text-center" type="number" min="5" max="1000" value="50" name="sentenceLength" id="sentenceLengthSelector">
							<h6 class="m-2">words from</h6><h4 id="mimicAuthor">' . $mimicSpeaker->getBuiltFromAuthors()[0] . '</h4>
						</div>
						<div class="btn-group m-2">
							<button class="btn btn-lg btn-outline-success" id="publishButton">Publish</button>
							<button class="btn btn-lg btn-outline-primary" id="previewButton">Preview</button>
						</div>
					</div>
				</div>
			</div>';
		return $mimicEditorHTML;
	}

	private static function createHTMLForMimicSpeakerBuilder(array $processedTexts, array $builtFromLongTitles, array $builtFromGenres, string $buildOptionDisplay): string
	{
		$titleSelector =
			'<select class="form-inline form-select w-50 h-75' . $buildOptionDisplay . '" name="shortTitle" id="titleSelector">
				<option value="" data-genre="">Random Title</option>';

		$genreSelector =
			'<select class="form-inline form-select w-50 h-75' . $buildOptionDisplay . '" name="genre" id="genreSelector">
				<option value="">Random Genre</option>';

		$uniqueGenres = [];
		foreach ($processedTexts as $text){
			$titleSelected = $text['full_title'] === $builtFromLongTitles[0] ? ' selected' : '';
			$genreSelected = $text['genre'] === $builtFromGenres[0] ? ' selected' : '';
			$titleSelector .= '<option value="' . $text['short_title'] . '"' . $titleSelected . ' data-genre="' . $text['genre'] . '">' . $text['full_title'] . '</option>';
			if (!in_array($text['genre'], $uniqueGenres)){
				$uniqueGenres[] = $text['genre'];
				$genreSelector .= '<option value="' . $text['genre'] . '"' . $genreSelected . '>' . $text['genre'] . '</option>';
			}
		}
		$titleSelector .= '</select>';
		$genreSelector .= '</select>';
		return $titleSelector . $genreSelector;
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