<?php

require __DIR__.'/../vendor/autoload.php';

use Hamedov\PassSorter\Pass;

// If input json file for boardings is provided we will use it.
// Other wise we will be using our sample data.

$inputFile = __DIR__ . '/input.json';
if (isset($argv[1]) && file_exists($argv[1])) {
	$inputFile = $argv[1];
}

$inputJson = file_get_contents($inputFile);

try {
	$boardings = json_decode($inputJson);
	$pass = (new Pass($boardings));
	$pass->sort();
	$pass->output();
} catch (\Exception $e) {
	echo 'Couldn\'t parse input file json: ' . $e->getMessage();
}
