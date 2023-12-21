<?php
$dataDir = "../../data/day04";
$cards = file("$dataDir/input.data");
// $cards = file("$dataDir/sample.data");

$result = [];
for ($i = 0; $i < count($cards); $i++) {
    $result[] = 1;
}
for ($i = 0; $i < count($cards); $i++) {
    $numbers = array_map(fn ($s): array => explode(' ', preg_replace('/\s+/', ' ', trim($s))), explode('|', substr($cards[$i], strpos($cards[$i], ":") + 1)));
    $inter = count(array_intersect($numbers[0], $numbers[1]));
    if ($inter > 0) {
        $toDupe = array_slice($result, ($i + 1), $inter, true);
        foreach ($toDupe as $k => $v) {
            $result[$k] += 1 * $result[$i];
        }
    }
}

print "Result: " . array_sum($result) . "\n";
