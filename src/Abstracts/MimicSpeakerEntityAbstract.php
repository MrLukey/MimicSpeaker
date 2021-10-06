<?php

namespace App\Abstracts;

abstract class MimicSpeakerEntityAbstract
{
	protected array $wordDictionary;

	public function buildFromText(string $textFilePath): void
	{
		$rawText = file_get_contents($textFilePath);
		$allWords = $this::processTextIntoArray($rawText);
		$this->wordDictionary = $this::buildWordDictionary($allWords);
	}

	public function buildFromJSON(string $jsonFilePath): void
	{
		$textFile = file_get_contents($jsonFilePath);
		$this->wordDictionary  = json_decode($textFile, true);
	}

	public function getWordDictionary(): array
	{
		return $this->wordDictionary;
	}

	public function mimic(int $sentenceLength): array
	{
		$currentWord = array_rand($this->wordDictionary);
		$mimicSpeech = [$currentWord];
		for ($i = 0; $i < $sentenceLength; $i++){
			if (isset($this->wordDictionary[$currentWord])){
				$currentWord = $this->wordDictionary[$currentWord][array_rand($this->wordDictionary[$currentWord])];
				$mimicSpeech[] = $currentWord;
			} else {
				$currentWord = array_rand($this->wordDictionary);
			}
		}
		return $mimicSpeech;
	}

	public function mergeWordData(MimicSpeakerEntityAbstract $mimicSpeaker): void
	{
		$this->wordDictionary = array_merge_recursive($this->wordDictionary, $mimicSpeaker->getWordDictionary());
	}

	protected static function processTextIntoArray(string $rawText): array
	{
		// remove typos or extra characters
		$mainText = preg_replace('/,[,.;:?!\']/', ',', $rawText);
		$mainText = preg_replace('/\.[,.;:?!\']/', '.', $mainText);
		$mainText = preg_replace('/;[,.;:?!\']/', ';', $mainText);
		$mainText = preg_replace('/:[,.;:?!\']/', ':', $mainText);
		$mainText = preg_replace('/\?[,.;:?!\']/', '?', $mainText);
		$mainText = preg_replace('/![,.;:?!\']/', '!', $mainText);
		$mainText = preg_replace('/\'[,.;:?!\']/', '!', $mainText);
		$mainText = preg_replace('/[a-z]--/', ', ', $mainText);
		$mainText = preg_replace('/\([!?]\)/', ' ', $mainText);

		// remove any '[text]', hopefully illustrations and footnotes. Remove underscores and quotation marks
		$mainText = preg_replace('/\[.*]|[_"]/', '', $mainText);

		// unpack '(text)' and '- text -' into comma separated ', text,' to merge them into sentences
		$mainText = preg_replace('/[()]| - /', ', ', $mainText);

		// tidy up extra characters generated through unpacking
		$mainText = preg_replace('/,? ,/', ',', $mainText);
		$mainText = preg_replace('/(,? )(?=[,.;:?!])/', '', $mainText);

		// remove extra '.' on formal gender titles
		$mainText = preg_replace('/(Mr\.)/', 'Mr', $mainText);
		$mainText = preg_replace('/(Mrs\.)/', 'Mrs', $mainText);

		// convert colons that separate time strings to ensure they remain intact
		$mainText = preg_replace('/(?<=\d\d|\d):(?=\d\d)/', 'XXXTIMECOLONXXX', $mainText);

		// convert 'a.m.' postfix, taking care to preserve punctuation
		$mainText = preg_replace('/(?<=[\d])(\sa\.m\.)(?=\s[a-z])/', ' am', $mainText);
		$mainText = preg_replace('/(?<=[\d])(\sa\.m\.)(?=\s[^a-z])/', ' am.', $mainText);

		// convert 'p.m.' postfix, taking care to preserve punctuation
		$mainText = preg_replace('/(?<=[\d])(\sp\.m\.)(?=\s[a-z])/', ' pm', $mainText);
		$mainText = preg_replace('/(?<=[\d])(\sp\.m\.)(?=\s[^a-z])/', ' pm.', $mainText);

		// convert 'm.p.h.' postfix, taking care to preserve punctuation
		$mainText = preg_replace('/(?<=[\d])(\sm\.p\.h\.)(?=\s[a-z])/', ' mph', $mainText);
		$mainText = preg_replace('/(?<=[\d])(\sm\.p\.h\.)(?=\s[^a-z])/', ' mph.', $mainText);

		// convert 'I.Q.' to ensure strings remain intact, taking care to preserve punctuation
		$mainText = preg_replace('/(I\.Q\.)(?=\s[a-z])/', ' iq', $mainText);
		$mainText = preg_replace('/(I\.Q\.)(?=\s[^a-z])/', ' iq.', $mainText);

		// split text into sentences
		$words = preg_split('/(?<=[,.;:!?\s])|(?=[,.;:!?])/', $mainText);

		$allWords = [];
		foreach ($words as $word){
			$word = preg_replace('/XXXTIMECOLONXXX/', ':', $word);
			$word= trim(strtolower($word));
			if (strlen($word) > 0){
				$allWords[] = $word;
			}
		}
		return $allWords;
	}

	protected static function buildWordDictionary(array $allWords): array
	{
		// build a word dictionary, to allow mimicking
		$wordDictionary = [];
		for ($i = 0; $i < count($allWords) - 1; $i++){
			$currentWord = $allWords[$i];
			$nextWord = $allWords[$i + 1];
			if(isset($wordDictionary[$currentWord])){
				if (!in_array($nextWord, $wordDictionary[$currentWord])){
					$wordDictionary[$currentWord][] = $nextWord;
				}
			} else {
				$wordDictionary[$currentWord] = [$nextWord];
			}
		}
		return $wordDictionary;
	}
}