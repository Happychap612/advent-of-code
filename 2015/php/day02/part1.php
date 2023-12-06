<?php

$data = file('input.data');
$result = 0;

for ($i = 0; $i < count($data); $i++) {
    $dim = explode('x', $data[$i]);

    $lw = $dim[0] * $dim[1];
    $wh = $dim[1] * $dim[2];
    $hl = $dim[2] * $dim[0];

    $result += min([$lw, $wh, $hl]);
    $result += ($lw * 2) + ($wh * 2) + ($hl * 2);
}

print "$result\n";
