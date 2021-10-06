<?php

$jsonFileToMimic = $argv[1];
$noOfWords = 1000;
$textFile = file_get_contents($jsonFileToMimic);
$wordDictionary = json_decode($textFile, true);
$currentWord = array_rand($wordDictionary);
$mimicSpeech = '' . $currentWord;
for ($i = 0; $i < $noOfWords; $i++){
	if (isset($wordDictionary[$currentWord])){
		$currentWord = $wordDictionary[$currentWord][array_rand($wordDictionary[$currentWord])];
		$mimicSpeech .= ' ' . $currentWord;
	} else {
		$currentWord = array_rand($wordDictionary);
	}
}
echo $mimicSpeech . "\n";