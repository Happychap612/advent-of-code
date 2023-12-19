<?php
$almanac = file('./input.data');
// $almanac = file('./sample.data');

// PROCESS ALMANAC INTO SECTIONS
// SEEDS
$seeds = array_shift($almanac);
$seeds = explode(" ", substr($seeds, strpos($seeds, ":") + 2));

$mapNames = ["seed", "soil", "fert", "water", "light", "temp", "humid"];
array_shift($almanac); // get rid of the first dead line so next is the beginning of the maps

foreach ($mapNames as $name) {
    $mapName = "{$name}Map";

    $$mapName = [];
    array_shift($almanac);
    $row = array_shift($almanac);
    while (trim($row) !== "") {
        $map = explode(" ", $row);
        $$mapName[] = $map;

        $row = array_shift($almanac);
    }
    unset($row);
}

$locations = [];
foreach ($seeds as $trace) {
    $trace = trim($trace);
    foreach ($mapNames as $name) {
        $mapName = "{$name}Map";
        $maps = $$mapName;
        foreach ($maps as $map) {
            $min = $map[1];
            $max = $map[1] + $map[2] - 1;
            if ($trace >= $min && $trace <= $max) {
                $trace = $map[0] + ($trace - $min);
                break;
            }
        }
    }

    $locations[] = $trace;
}

$result = min($locations);
print "Result: $result\n";
