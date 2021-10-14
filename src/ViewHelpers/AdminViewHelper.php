<?php

namespace App\ViewHelpers;

class AdminViewHelper
{
	public static function createHTMLForTextProcessorForm(): string
	{
		return
			'<div class="form-group">
				<label for="fullTitle">Full Title:</label>
				<input type="text" max="120" id="fullTitle" required>
			</div>
			<div class="form-group">
				<label for="shortTitle">Short Title:</label>
				<input type="text" max="30" id="shortTitle" required>
			</div>
			<div class="form-group">
				<label for="author">Author:</label>
				<input type="text" max="120" id="author" required>
			</div>
			<div class="form-group">
				<label for="published">First Published:</label>
				<div>
					<label for="day">Day:</label>
					<input type="number" min="1" max="31" id="published" id="day" required>
					<label for="month">Month:</label>
					<input type="number" min="1" max="12" id="published" id="month" required>
					<label for="year">Year:</label>
					<input type="number" max="2021" id="published" id="year" required>
				</div>
			</div>
			<div class="form-group">
				<label for="genre">Genre:</label>
				<input type="text" max="120" id="genre" required>
			</div>
			<div class="form-group">
				<label for="inputFile">Text File:</label>
				<input type="file" class="form-control-file" name="inputFile" id="inputFile">
			</div>';
	}
}