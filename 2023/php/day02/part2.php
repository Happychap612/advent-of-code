<?php
$data = file('./input.data');
// $data = file('./sample.data');
$result = 0;

for ($x = 0; $x < count($data); $x++) {
    $datum = $data[$x];
    $proc = substr($datum, 5); // string without 'Game ' at the start
    $proc = substr($proc, stripos($proc, ':') + 2); // the pur game results

    $gameMax = [
        'red' => 0,
        'blue' => 0,
        'green' => 0,
    ];

    $rounds = explode(';', $proc);
    for ($y = 0; $y < count($rounds); $y++) {
        $rounds[$y] = explode(',', $rounds[$y]);

        for ($z = 0; $z < count($rounds[$y]); $z++) {
            $f = explode(' ', trim($rounds[$y][$z]));

            $r = [];
            $r[$f[1]] = $f[0];

            if (array_key_exists('blue', $r) && $gameMax['blue'] < $r['blue']) {
                $gameMax['blue'] = $r['blue'];
            }
            if (array_key_exists('red', $r) && $gameMax['red'] < $r['red']) {
                $gameMax['red'] = $r['red'];
            }
            if (array_key_exists('green', $r) && $gameMax['green'] < $r['green']) {
                $gameMax['green'] = $r['green'];
            }
        }
    }

    $result += ($gameMax['blue'] * $gameMax['red'] * $gameMax['green']);
}

print $result . PHP_EOL;
