<?php
$data = file('./input_data');
// $data = file('./sample_data');
$result = 0;

for ($i = 0; $i < count($data); $i++) {
    $datum = $data[$i];
    preg_match_all('!\d!', $datum, $matches);

    $matches = $matches[0];

    $result += $matches[0] . $matches[count($matches) - 1];
}

print $result . PHP_EOL;
