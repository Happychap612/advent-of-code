<?php
$dataDir = "../../data/day05";
$almanac = file("$dataDir/input.data");
// $almanac = file("$dataDir/sample.data");

// @TODO come back and do this right you cheating fuck

// PROCESS ALMANAC INTO SECTIONS
// SEEDS
$seeds = array_shift($almanac);
$seeds = explode(" ", substr($seeds, strpos($seeds, ":") + 2));
$seeds = array_map(fn ($s): string => trim($s), $seeds);
$seeds = array_chunk($seeds, 2);

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

$location = null;
foreach ($seeds as $seed) {
    for ($i = 0; $i < $seed[1]; $i++) {
        $trace = $seed[0] + $i;
        print "$i/$seed[1] - $location\n";

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

        if ($trace < $location or $location == null) {
            $location = $trace;
        }
    }
}

print "Result: $location\n";
