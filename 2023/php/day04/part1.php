<?php
$cards = file('./input.data');
// $cards = file('./sample.data');

$result = 0;

for ($i = 0; $i < count($cards); $i++) {
    $numbers = array_map(fn ($s): array => explode(' ', preg_replace('/\s+/', ' ', trim($s))), explode('|', substr($cards[$i], strpos($cards[$i], ":") + 1)));
    $inter = count(array_intersect($numbers[0], $numbers[1]));
    $result += $inter == 0 ? 0 : pow(2, $inter - 1);
}

print "Result: $result\n";
