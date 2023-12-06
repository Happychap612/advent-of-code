<?php
$data = file('./input.data');
// $data = file('./sample.data');
$result = 0;

$bag = [
    'red' => 12,
    'green' => 13,
    'blue' => 14,
];

for ($x = 0; $x < count($data); $x++) {
    $datum = $data[$x];
    $proc = substr($datum, 5); // string without 'Game ' at the start
    $ID = substr($proc, 0, stripos($proc, ':')); // the game ID 
    $proc = substr($proc, stripos($proc, ':') + 2); // the pur game results

    $rounds = explode(';', $proc);
    for ($y = 0; $y < count($rounds); $y++) {
        $rounds[$y] = explode(',', $rounds[$y]);

        $fail = false;
        for ($z = 0; $z < count($rounds[$y]); $z++) {
            $f = explode(' ', trim($rounds[$y][$z]));

            $r = [];
            $r[$f[1]] = $f[0];

            if (array_key_exists('blue', $r) && $r['blue'] > $bag['blue']) {
                $fail = true;
            }
            if (array_key_exists('red', $r) && $r['red'] > $bag['red']) {
                $fail = true;
            }
            if (array_key_exists('green', $r) && $r['green'] > $bag['green']) {
                $fail = true;
            }

            if ($fail) {
                break;
            }
        }
        if ($fail) {
            break;
        }
    }

    if (!$fail) {
        $result += $ID;
    }
}

print $result . PHP_EOL;
