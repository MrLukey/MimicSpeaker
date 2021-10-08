<?php

namespace App\ViewHelpers;

class AdminViewHelper
{
	public static function createHTMLForTextFileProcessing(array $processedTexts): string
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
	}
}