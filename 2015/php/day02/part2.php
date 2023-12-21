<?php

$data = file('../../data/day02/input.data');
$result = 0;

for ($i = 0; $i < count($data); $i++) {
    $dim = explode('x', $data[$i]);

    $vol = $dim[0] * $dim[1] * $dim[2];
    sort($dim);
    $result += $vol;
    $result += ($dim[0] * 2) + ($dim[1] * 2);
}

print "$result\n";
