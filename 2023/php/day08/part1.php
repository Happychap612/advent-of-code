<?php
$dataDir = "../../data/day08";
$mapData = file("$dataDir/input.data");
// $mapData = file("$dataDir/sample1.data");
// $mapData = file("$dataDir/sample2.data");

$directions = array_shift($mapData);
array_shift($mapData);

$map = [];
foreach ($mapData as $mapDatum) {
    preg_match_all('!([A-Z])\w+!', substr($mapDatum, 6), $inst);
    $map[substr($mapDatum, 0, 3)] = [
        "L" => $inst[0][0],
        "R" => $inst[0][1],
    ];
}

$currentPos = "AAA";
$dirLen = strlen($directions);

for ($i = 0; $currentPos !== "ZZZ"; $i++) {
    $currentPos = $map[$currentPos][$directions[$i % ($dirLen - 1)]];
}

print "Result: $i\n";
