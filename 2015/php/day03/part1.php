<?php

$data = file('input.data');
$result = ["0,0" => 1];
$inst = $data[0];
$x = 0;
$y = 0;

for ($i = 0; $i < strlen($inst); $i++) {
    switch ($inst[$i]) {
        case '^':
            $y++;
            break;
        case 'v':
            $y--;
            break;
        case '>':
            $x++;
            break;
        case '<':
            $x--;
            break;
        default:
            print "PANIC?";
    }
    $key = "$x, $y";
    if (array_key_exists($key, $result)) {
        $result[$key]++;
    } else {
        $result[$key] = 1;
    }
}

print count($result) . PHP_EOL;
