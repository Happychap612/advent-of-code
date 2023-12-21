<?php

$data = file('../../data/day01/input.data');

$floor = 0;
$floorData = $data[0];

for ($i = 0; $i < strlen($floorData) && $floor >= 0; $i++) {
    $floor += $floorData[$i] == '(' ? 1 : -1;
}

print "$i\n";
