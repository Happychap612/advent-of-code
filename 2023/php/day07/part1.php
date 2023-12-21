<?php
$dataDir = "../../data/day07";
// $hands = file("$dataDir/input.data");
$hands = file("$dataDir/sample.data");

$hands = array_map(fn ($h): array => explode(" ", trim($h)), $hands);
print_r($hands);
