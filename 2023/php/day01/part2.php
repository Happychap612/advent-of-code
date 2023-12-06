<?php
$data = file('./input.data');
// $data = file('./sample.data');
$result = 0;

$matchers = [
    '1',
    '2',
    '3',
    '4',
    '5',
    '6',
    '7',
    '8',
    '9',
    'one',
    'two',
    'three',
    'four',
    'five',
    'six',
    'seven',
    'eight',
    'nine',
];
$wordNumberConversion = [
    'one' => 1,
    'two' => 2,
    'three' => 3,
    'four' => 4,
    'five' => 5,
    'six' => 6,
    'seven' => 7,
    'eight' => 8,
    'nine' => 9,
];

for ($i = 0; $i < count($data); $i++) {
    $datum = $data[$i];
    $firstMatches = [];
    $lastMatches = [];
    for ($z = 0; $z < 18; $z++) {
        $needle = $matchers[$z];
        $firstMatches[$needle] = stripos($datum, $needle);
        if ($firstMatches[$needle] === false) {
            unset($firstMatches[$needle]);
        }
        $lastMatches[$needle] = strrpos($datum, $needle);
        if ($lastMatches[$needle] === false) {
            unset($lastMatches[$needle]);
        }
    }
    asort($firstMatches);
    arsort($lastMatches);

    $fk = array_key_first($firstMatches);
    $lk = array_key_first($lastMatches);

    if (strlen($fk) > 1) {
        $fk = $wordNumberConversion[$fk];
    } else {
        $fk = intval($fk);
    }

    if (strlen($lk) > 1) {
        $lk = $wordNumberConversion[$lk];
    } else {
        $lk = intval($lk);
    }

    $result += $fk . $lk;
}

print $result . PHP_EOL;
