<?php

namespace App\Abstracts;

abstract class MimicSpeakerEntityAbstract
{
	protected array $startWords;
	protected array $wordDictionary;

	public function buildFromText(string $textFilePath): void
	{
		$rawText = file_get_contents($textFilePath);
		$processedText = $this::processText($rawText);
		[$this->startWords, $allWords] = $this::buildWordArrays($processedText);
		$this->wordDictionary = $this::buildWordDictionary($allWords);
	}

	public function buildFromJSON(string $jsonFilePath): void
	{
		$textFile = file_get_contents($jsonFilePath);
		$textData = json_decode($textFile, true);
		$this->startWords = $textData['startWords'];
		$this->wordDictionary = $textData['wordDictionary'];
	}

	public function getStartWords(): array
	{
		return $this->startWords;
	}

	public function getWordDictionary(): array
	{
		return $this->wordDictionary;
	}

	public function mimic(int $sentenceLength): array
	{
		$currentWord = $this->startWords[array_rand($this->startWords)];
		$mimicSpeech = [$currentWord];
		for ($i = 0; $i < $sentenceLength; $i++){
			if (isset($this->wordDictionary[$currentWord])){
				$currentWord = $this->wordDictionary[$currentWord][array_rand($this->wordDictionary[$currentWord])];
				$mimicSpeech[] = $currentWord;
			} else {
				break;
			}
		}
		return $mimicSpeech;
	}

	public function mergeWordData(MimicSpeakerEntityAbstract $mimicSpeaker): void
	{
		$this->startWords = array_merge($this->startWords, $mimicSpeaker->getStartWords());
		$this->wordDictionary = array_merge_recursive($this->wordDictionary, $mimicSpeaker->getWordDictionary());
	}

	protected static function processText(string $rawText): string
	{
		$mainText = preg_replace('/,[,.;:?!\'"]/', ',', $rawText);
		$mainText = preg_replace('/\.[,.;:?!\'"]/', '.', $mainText);
		$mainText = preg_replace('/;[,.;:?!\'"]/', ';', $mainText);
		$mainText = preg_replace('/:[,.;:?!\'"]/', ':', $mainText);
		$mainText = preg_replace('/![,.;:?!\'"]/', '!', $mainText);
		$mainText = preg_replace('/\?[,.;:?!\'"]/', '?', $mainText);
		$mainText = preg_replace('/[a-z]--/', ', ', $mainText);
		$mainText = preg_replace('/\([!?]\)/', ' ', $mainText);

		// remove any '[text]', hopefully illustrations and footnotes. Remove underscores and quotation marks
		$mainText = preg_replace('/\[.*]|[_"]/', '', $mainText);

		// unpack '(text)' and '- text -' into comma separated ', text,' to merge them into sentences
		$mainText = preg_replace('/[()]| - /', ', ', $mainText);

		// tidy up extra characters generated through unpacking
		$mainText = preg_replace('/,? ,/', ',', $mainText);
		$mainText = preg_replace('/(,? )(?=[,.;:?!])/', '', $mainText);

		// merge 'Mr. and Mrs. Barry.' into 'XXXMRXXX and XXXMRS2XXXBARRY.' to preserve title and name pairs with punctuation.
		$mainText = preg_replace('/(Mr\.\s)(?=[A-Z])/', 'XXXMRXXX', $mainText);
		$mainText = preg_replace('/(Mr\.\s)(?=[^A-Z])/', 'XXXMR2XXX ', $mainText);
		$mainText = preg_replace('/(Mrs\.\s)(?=[A-Z])/', 'XXXMRSXXX', $mainText);
		$mainText = preg_replace('/(Mrs\.\s)(?=[^A-Z])/', 'XXXMRS2XXX ', $mainText);

		// convert colons that separate time strings to ensure they remain intact
		$mainText = preg_replace('/(?<=\d\d|\d):(?=\d\d)/', 'XXXTIMECOLONXXX', $mainText);

		// convert 'a.m.' postfix, taking care to preserve punctuation
		$mainText = preg_replace('/(?<=[\d])(\sa\.m\.)(?=\s[a-z])/', ' XXXAMXXX', $mainText);
		$mainText = preg_replace('/(?<=[\d])(\sa\.m\.)(?=\s[^a-z])/', ' XXXAM2XXX. ', $mainText);

		// convert 'p.m.' postfix, taking care to preserve punctuation
		$mainText = preg_replace('/(?<=[\d])(\sp\.m\.)(?=\s[a-z])/', ' XXXPMXXX', $mainText);
		$mainText = preg_replace('/(?<=[\d])(\sp\.m\.)(?=\s[^a-z])/', ' XXXPM2XXX. ', $mainText);

		// convert 'm.p.h.' postfix, taking care to preserve punctuation
		$mainText = preg_replace('/(?<=[\d])(\sm\.p\.h\.)(?=\s[a-z])/', 'XXXMPHXXX', $mainText);
		$mainText = preg_replace('/(?<=[\d])(\sm\.p\.h\.)(?=\s[^a-z])/', 'XXXMPH2XXX. ', $mainText);

		// convert 'I.Q.' to ensure strings remain intact, taking care to preserve punctuation
		$mainText = preg_replace('/(I\.Q\.)(?=\s[a-z])/', ' XXXIQXXX', $mainText);
		$mainText = preg_replace('/(I\.Q\.)(?=\s[^a-z])/', 'XXXIQXXX. ', $mainText);

		// merge single letter name abbreviations into a single string e.g 'L. Landau' => 'LXXXNAMEXXXLandau' (won't work for any I names)
		return preg_replace('/(?<=\s[A-HJ-Z])(\. )(?=[A-Za-z])/', 'XXXNAMEXXX', $mainText);
	}

	protected static function buildWordArrays(string $processedText): array
	{
		$sentences = preg_split('/(?<=[.!?])/', $processedText);

		// restore converted string values and build array of words
		$startWords = [];
		$allWords = [];
		foreach ($sentences as $i => $sentence){
			preg_match_all('/[A-Za-z0-9]+\S?[A-Za-z]*[,.:;!?\s]?/', $sentence, $words);
			if (count($words[0]) > 1){
				foreach ($words[0] as $j => $word){
					$word = preg_replace('/XXXMRXXX/', 'Mr. ', $word);
					$word = preg_replace('/XXXMR2XXX/', 'Mr.', $word);
					$word = preg_replace('/XXXMRSXXX/', 'Mrs. ', $word);
					$word = preg_replace('/XXXMRS2XXX/', 'Mrs.', $word);
					$word = preg_replace('/XXXTIMECOLONXXX/', ':', $word);
					$word = preg_replace('/XXXAMXXX/', ' a.m.', $word);
					$word = preg_replace('/XXXAM2XXX/', ' a.m', $word);
					$word = preg_replace('/XXXPMXXX/', ' p.m.', $word);
					$word = preg_replace('/XXXPM2XXX/', ' p.m', $word);
					$word = preg_replace('/XXXMPHXXX/', ' mph', $word);
					$word = preg_replace('/XXXIQXXX/', ' IQ', $word);
					$word = preg_replace('/XXXNAMEXXX/', '. ', $word);
					$word = trim($word);
					if ($j === 0){
						$word = ucfirst($word);
						if (!in_array($word, $startWords)){
							$startWords[] = $word;
						}
					}
					$allWords[] = $word;
				}
			}
		}
		return [$startWords, $allWords];
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