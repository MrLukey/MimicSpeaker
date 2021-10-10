<?php

namespace App\ViewHelpers;

use App\Abstracts\MimicSpeakerEntityAbstract;

class MimicViewHelper
{
	public static function createHTMLForMimicEditor(array $mimic, array $processedTexts, ?MimicSpeakerEntityAbstract $mimicSpeaker): string
	{
		if ($mimicSpeaker !== null && count($mimicSpeaker->getBuiltFromLongTitles()) > 0){
			$mimicTitle = $mimicSpeaker->getBuiltFromLongTitles()[0];
			$mimicAuthor = $mimicSpeaker->getBuiltFromAuthors()[0];
			$mimicGenre = $mimicSpeaker->getBuiltFromGenres()[0];
			$buildOptionDisplay = ' d-none';
			$buildDisplay = '';
			$buildButtonText = 'Edit Mimic Speaker';
			$buildButtonStyle = ' btn-outline-primary';
			$mimicButtonStyle = ' btn-primary';
		} else {
			$mimicTitle = '';
			$mimicAuthor = '';
			$mimicGenre = '';
			$buildOptionDisplay = '';
			$buildDisplay = ' d-none';
			$buildButtonText = 'Build Mimic Speaker';
			$buildButtonStyle = ' btn-primary';
			$mimicButtonStyle = ' btn-outline-primary';
		}
		if (count($mimic) < 1){
			$publishButtonStyle = ' btn-outline-success';
			$previewButtonStyle = ' btn-outline-primary';
		} else {
			$publishButtonStyle = ' btn-success';
			$previewButtonStyle = ' btn-primary';
		}
		$mimicEditorHTML =
			'<div class="vh-100 d-flex align-items-center justify-content-center">
				<div class="container h-75">
					<div class="card rounded-3 h-100 align-middle position-relative">
						<div class="card-header d-flex flex-row flex-wrap justify-content-between align-items-baseline">
							<div class="row m-2 col-12"></div>
							<button type="button" class="btn-close position-absolute top-1 start-1" aria-label="Close" id="closeCreatorButton"></button>
							<div class="d-flex flex-row row-nowrap w-75">
								<h4 class="' . $buildDisplay . '" id="mimicSpeakerBuild" data-title="' . $mimicTitle . '">' . $mimicTitle . '</h4>' .
								MimicViewHelper::createHTMLForMimicSpeakerBuilder(
											$processedTexts, $mimicTitle, $mimicGenre, $buildOptionDisplay) .
							'</div>
							<button class="btn btn-lg' . $buildButtonStyle . ' text-nowrap m-2 flex-grow-4" id="buildMimicSpeaker">' . $buildButtonText . '</button>
						</div>
						<div class="card-body d-none d-flex overflow-auto" id="mimicPreview"></div>
						<div class="card-body d-flex overflow-auto" id="wordEditor">
							<div class="w-75 m-auto" id="wordsContainer">';
							foreach ($mimic as $index => $word){
								$mimicEditorHTML .=
								'<div class="wordWrapper m-1">
									<button class="wordButton btn btn-lg btn-outline-dark"
											id="wordButton' . $index . '"
											data-edited="false"
											data-id="' . $index . '">' . $word . '</button>' .
									MimicViewHelper::createHTMLForEditingButtons($index) .
								'</div>';
								}
			$mimicEditorHTML .=
							'</div>
						</div>
						<div class="card-footer d-flex flex-row flex-wrap justify-content-between">
							<div class="d-flex row-wrap align-items-baseline">
								<button class="btn btn-lg' . $mimicButtonStyle . ' m-2" id="mimicButton">Mimic</button>
								<input class="h-75 text-center" type="number" min="5" max="1000" value="50" name="sentenceLength" id="sentenceLengthSelector">
								<h6 class="m-2">words from</h6><h4 id="mimicAuthor" data-author="' . $mimicAuthor . '">' . $mimicAuthor . '</h4>
							</div>
							<div class="m-2">
								<button class="btn btn-lg' . $publishButtonStyle . '" id="publishButton">Publish</button>
								<button class="btn btn-lg' . $previewButtonStyle . '" id="previewButton">Preview</button>
							</div>
						</div>
					</div>
				</div>
			</div>';
		return $mimicEditorHTML;
	}

	private static function createHTMLForMimicSpeakerBuilder(array $processedTexts, string $originalBuildLongTitle, string $originalBuildGenre, string $buildOptionDisplay): string
	{
		$titleSelector =
			'<select class="form-inline form-select p-2' . $buildOptionDisplay . '" name="shortTitle" id="titleSelector">
				<option value="" data-genre="">Random Title</option>';

		$genreSelector =
			'<select class="form-inline form-select p-2' . $buildOptionDisplay . '" name="genre" id="genreSelector">
				<option value="">Random Genre</option>';

		$uniqueGenres = [];
		foreach ($processedTexts as $text){
			$titleSelected = $text['full_title'] === $originalBuildLongTitle ? ' selected' : '';
			$genreSelected = $text['genre'] === $originalBuildGenre ? ' selected' : '';
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
					<button class="clearButton btn btn-md btn-secondary" data-id="' . $wordID .'"> </button>
					<button class="commaButton btn btn-md btn-secondary" data-id="' . $wordID .'">,</button>
					<button class="fullStopButton btn btn-md btn-secondary" data-id="' . $wordID .'">.</button>
					<button class="semicolonButton btn btn-md btn-secondary" data-id="' . $wordID .'">;</button>
					<button class="colonButton btn btn-md btn-secondary" data-id="' . $wordID .'">:</button>
					<button class="exclamationButton btn btn-md btn-secondary" data-id="' . $wordID .'">!</button>
					<button class="questionButton btn btn-md btn-secondary" data-id="' . $wordID .'">?</button>
				</div>
				<div class="btn-group" role="group">
					<button class="allLowerButton btn btn-md btn-secondary" data-id="' . $wordID .'">aaa</button>
					<button class="firstCapsButton btn btn-md btn-secondary" data-id="' . $wordID .'">Aaa</button>
					<button class="allCapsButton btn btn-md btn-secondary" data-id="' . $wordID .'">AAA</button>
					<button class="deleteButton btn btn-md btn-secondary" data-id="' . $wordID .'">Delete</button>
				</div>
			</div>';
	}
}