<?php
//
//$jsonFileToMimic = $argv[1];
//$noOfWords = 20;
//$textFile = file_get_contents($jsonFileToMimic);
//$textData = json_decode($textFile, true);
//$startWords = $textData['startWords'];
//$wordDictionary = $textData['wordDictionary'];
//$currentWord = $startWords[array_rand($startWords)];
//$mimicSpeech = '' . $currentWord;
//for ($i = 0; $i < $noOfWords; $i++){
//	if (isset($wordDictionary[$currentWord])){
//		$currentWord = $wordDictionary[$currentWord][array_rand($wordDictionary[$currentWord])];
//		$mimicSpeech .= ' ' . $currentWord;
//	}
//}
//echo $mimicSpeech . "\n";