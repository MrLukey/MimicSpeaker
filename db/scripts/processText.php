<?php
////replace — with spaces
//// replace ’ with '
//
//if (!isset($argv[1]) | !isset($argv[2])){
//	echo "Usage: php processText.php [text-file-to-process] [title-of-text] [--replace|-r]?\n";
//	exit(0);
//}
//$inputFile = $argv[1];
//$textName = $argv[2];
//$replace = $argv[3] ?? null;
//$outputFile = 'textJSONs/' . $textName . '.json';
//if (file_exists($outputFile) && !$replace && !in_array($replace, ['--replace', '-r'])){
//	echo 'Text has already been converted. Use --replace (-r) to overwrite.';
//	exit(0);
//}
//
//// get file as string
//$mainText = file_get_contents($inputFile);
////$mainText = substr($mainText, 0, 100);
////$textString = file_get_contents('NotebooksOfLeonardoDaVinci.txt');
//
//// breakup Gutenberg book into three sections, to extract the main text
////[$preface, $mainText, $legals] = preg_split('/\*\*\* [START|END]+.*\*\*\*/', $textString);
//
//
//// remove extra '.'s, unpack '(text)' into ', text,' remove '[text]', '_'s and Chapter titles.
////$mainText = preg_replace(['/Mr\./', '/Mrs\./', '/[()]/', '/,? ,| - /', '/\[.*\]/', '/[_"]+/', '/Chapter.{1,10}\./'], ['Mr', 'Mrs', ', ', ',', '', '', ''], $textString);
////$mainText = preg_replace('/(?<=[A-HJ-Z]|Mrs|Mr)(\.)/', '', $textString);
//
//// remove chapter titles
////$mainText = preg_replace('/Chapter\s[0-9|MDCLXVI]{1,10}/', '', $textString);
////$mainText = preg_replace(['/,,/', '..', ';;', '::', '!!', '??'], [',', '.', ';', ':', '!', '?'], $mainText);
//
//
//
//// remove typos or extra characters
//$mainText = preg_replace('/,[,.;:?!\'"]/', ',', $mainText);
//$mainText = preg_replace('/\.[,.;:?!\'"]/', '.', $mainText);
//$mainText = preg_replace('/;[,.;:?!\'"]/', ';', $mainText);
//$mainText = preg_replace('/:[,.;:?!\'"]/', ':', $mainText);
//$mainText = preg_replace('/![,.;:?!\'"]/', '!', $mainText);
//$mainText = preg_replace('/\?[,.;:?!\'"]/', '?', $mainText);
//$mainText = preg_replace('/[a-z]--/', ', ', $mainText);
//$mainText = preg_replace('/\([!?]\)/', ' ', $mainText);
//
//// remove any '[text]', hopefully illustrations and footnotes. Remove underscores and quotation marks
//$mainText = preg_replace('/\[.*]|[_"]/', '', $mainText);
//
//// unpack '(text)' and '- text -' into comma separated ', text,' to merge them into sentences
//$mainText = preg_replace('/[()]| - /', ', ', $mainText);
//
//// tidy up extra characters generated through unpacking
//$mainText = preg_replace('/,? ,/', ',', $mainText);
//$mainText = preg_replace('/(,? )(?=[,.;:?!])/', '', $mainText);
//
//// merge 'Mr. and Mrs. Barry.' into 'XXXMRXXX and XXXMRS2XXXBARRY.' to preserve title and name pairs with punctuation.
//$mainText = preg_replace('/(Mr\.\s)(?=[A-Z])/', 'XXXMRXXX', $mainText);
//$mainText = preg_replace('/(Mr\.\s)(?=[^A-Z])/', 'XXXMR2XXX ', $mainText);
//$mainText = preg_replace('/(Mrs\.\s)(?=[A-Z])/', 'XXXMRSXXX', $mainText);
//$mainText = preg_replace('/(Mrs\.\s)(?=[^A-Z])/', 'XXXMRS2XXX ', $mainText);
//
//// convert colons that separate time strings to ensure they remain intact
//$mainText = preg_replace('/(?<=\d\d|\d):(?=\d\d)/', 'XXXTIMECOLONXXX', $mainText);
//
//// convert 'a.m.' postfix, taking care to preserve punctuation
//$mainText = preg_replace('/(?<=[\d])(\sa\.m\.)(?=\s[a-z])/', ' XXXAMXXX', $mainText);
//$mainText = preg_replace('/(?<=[\d])(\sa\.m\.)(?=\s[^a-z])/', ' XXXAM2XXX. ', $mainText);
//
//// convert 'p.m.' postfix, taking care to preserve punctuation
//$mainText = preg_replace('/(?<=[\d])(\sp\.m\.)(?=\s[a-z])/', ' XXXPMXXX', $mainText);
//$mainText = preg_replace('/(?<=[\d])(\sp\.m\.)(?=\s[^a-z])/', ' XXXPM2XXX. ', $mainText);
//
//// convert 'm.p.h.' postfix, taking care to preserve punctuation
//$mainText = preg_replace('/(?<=[\d])(\sm\.p\.h\.)(?=\s[a-z])/', 'XXXMPHXXX', $mainText);
//$mainText = preg_replace('/(?<=[\d])(\sm\.p\.h\.)(?=\s[^a-z])/', 'XXXMPH2XXX. ', $mainText);
//
//// convert 'I.Q.' to ensure strings remain intact, taking care to preserve punctuation
//$mainText = preg_replace('/(I\.Q\.)(?=\s[a-z])/', ' XXXIQXXX', $mainText);
//$mainText = preg_replace('/(I\.Q\.)(?=\s[^a-z])/', 'XXXIQXXX. ', $mainText);
//
////$mainText = preg_replace('/\[[.\s]*]/', '', $mainText);
//
//// merge single letter name abbreviations into a single string e.g 'L. Landau' => 'LXXXNAMEXXXLandau' (won't work for any I names)
//$mainText = preg_replace('/(?<=\s[A-HJ-Z])(\. )(?=[A-Za-z])/', 'XXXNAMEXXX', $mainText);
//
//// do stuff for distances etc
////$mainText = preg_replace('/\d+ m/', '', $mainText);
//
//// split text into sentences
//$sentences = preg_split('/(?<=[.!?])/', $mainText);
////print_r($sentences);
//
//
//// restore converted string values and build array of words
//$startWords = [];
//$endWords = [];
//$allWords = [];
//foreach ($sentences as $i => $sentence){
//	$cleanSentence = [];
//	preg_match_all('/[A-Za-z0-9]+\S?[A-Za-z]*[,.:;!?\s]?/', $sentence, $words);
//	if (count($words[0]) > 1){
//		foreach ($words[0] as $j => $word){
//			$word = preg_replace('/XXXMRXXX/', 'Mr. ', $word);
//			$word = preg_replace('/XXXMR2XXX/', 'Mr.', $word);
//			$word = preg_replace('/XXXMRSXXX/', 'Mrs. ', $word);
//			$word = preg_replace('/XXXMRS2XXX/', 'Mrs.', $word);
//			$word = preg_replace('/XXXTIMECOLONXXX/', ':', $word);
//			$word = preg_replace('/XXXAMXXX/', ' a.m.', $word);
//			$word = preg_replace('/XXXAM2XXX/', ' a.m', $word);
//			$word = preg_replace('/XXXPMXXX/', ' p.m.', $word);
//			$word = preg_replace('/XXXPM2XXX/', ' p.m', $word);
//			$word = preg_replace('/XXXMPHXXX/', ' mph', $word);
//			$word = preg_replace('/XXXIQXXX/', ' IQ', $word);
//			$word = preg_replace('/XXXNAMEXXX/', '. ', $word);
//			$word = trim($word);
//			if ($j === 0){
//				$word = ucfirst($word);
//				if (!in_array($word, $startWords)){
//					$startWords[] = $word;
//				}
//			} elseif ($j === count($words[0]) - 1){
//				if (!in_array($word, $endWords)){
//					$endWords[] = $word;
//				}
//			}
//			$allWords[] = $word;
//		}
//	}
//}
////print_r($allWords);
//
//
//// build a word dictionary, to allow mimicking
//$wordDictionary = [];
//for ($i = 0; $i < count($allWords) - 1; $i++){
//	$currentWord = $allWords[$i];
//	$nextWord = $allWords[$i + 1];
//	if(isset($wordDictionary[$currentWord])){
//		if (!in_array($nextWord, $wordDictionary[$currentWord])){
//			$wordDictionary[$currentWord][] = $nextWord;
//		}
//	} else {
//		$wordDictionary[$currentWord] = [$nextWord];
//	}
//}
////print_r($wordDictionary);
////print_r($startWords);
//
//
//
//$textData = [
//	'startWords' => $startWords,
//	'wordDictionary' => $wordDictionary
//];
//
//$jsonData = json_encode($textData, JSON_INVALID_UTF8_IGNORE);
//file_put_contents($outputFile, $jsonData);