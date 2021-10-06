<?php
// replace — with spaces
// replace ’ with '

if (!isset($argv[1]) | !isset($argv[2])){
	echo "Usage: php processText.php [text-file-to-process] [title-of-text] [--replace|-r]?\n";
	exit(0);
}
$inputFile = $argv[1];
$textName = $argv[2];
$replace = $argv[3] ?? null;
$outputFile = '../textJSONs/' . $textName . '.json';
if (file_exists($outputFile) && !$replace && !in_array($replace, ['--replace', '-r'])){
	echo 'Text has already been converted. Use --replace (-r) to overwrite.';
	exit(0);
}

// get file as string
$mainText = file_get_contents($inputFile);
//$mainText = substr($mainText, 0, 100);
//$textString = file_get_contents('NotebooksOfLeonardoDaVinci.txt');

// breakup Gutenberg book into three sections, to extract the main text
//[$preface, $mainText, $legals] = preg_split('/\*\*\* [START|END]+.*\*\*\*/', $textString);


// remove extra '.'s, unpack '(text)' into ', text,' remove '[text]', '_'s and Chapter titles.
//$mainText = preg_replace(['/Mr\./', '/Mrs\./', '/[()]/', '/,? ,| - /', '/\[.*\]/', '/[_"]+/', '/Chapter.{1,10}\./'], ['Mr', 'Mrs', ', ', ',', '', '', ''], $textString);
//$mainText = preg_replace('/(?<=[A-HJ-Z]|Mrs|Mr)(\.)/', '', $textString);

// remove chapter titles
//$mainText = preg_replace('/Chapter\s[0-9|MDCLXVI]{1,10}/', '', $textString);
//$mainText = preg_replace(['/,,/', '..', ';;', '::', '!!', '??'], [',', '.', ';', ':', '!', '?'], $mainText);



// remove typos or extra characters
$mainText = preg_replace('/,[,.;:?!\']/', ',', $mainText);
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
foreach ($words as $key => $word){
	$word = preg_replace('/XXXTIMECOLONXXX/', ':', $word);
	$word= trim(strtolower($word));
	if (strlen($word) > 0){
		$allWords[] = $word;
	}
}
//print_r($allWords);

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

$jsonData = json_encode($wordDictionary, JSON_INVALID_UTF8_IGNORE);
file_put_contents($outputFile, $jsonData);