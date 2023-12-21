<?php
$dataDir = "../../data/day08";
$mapData = file_get_contents("$dataDir/input.data");
// $mapData = file_get_contents("$dataDir/sample1.data");
// $mapData = file_get_contents("$dataDir/sample2.data");
// $mapData = file_get_contents("$dataDir/sample3.data");
$mapData = explode("\n", $mapData);

$directions = array_shift($mapData);
array_shift($mapData);

function gcd($a, $b)
{
    [$a, $b] = $a > $b ? [$b, $a] : [$a, $b];

    for ($gcd = 2; $gcd <= $b; $gcd++) {
        if ($a % $gcd === 0 && $b % $gcd === 0) return $gcd;
    }
    return 1;
}

$map = [];
$nodes = [];
$regex = '!(\w+)!';
foreach ($mapData as $mapDatum) {
    preg_match_all($regex, substr($mapDatum, 6), $inst);
    $key = substr($mapDatum, 0, 3);
    if ($key[2] == 'A') {
        $nodes[] = $key;
    }
    $map[$key] = [
        "L" => $inst[0][0],
        "R" => $inst[0][1],
    ];
}

$dirLen = strlen($directions);
$finNodes = [];
foreach ($nodes as &$node) {
    for ($i = 0; $node[2] !== 'Z'; $i++) {
        $LR = $directions[$i % $dirLen];
        $node = $map[$node][$LR];
    }
    $finNodes[] = $i;
}

$result = array_reduce($finNodes, fn ($carry, $item) => ($carry * $item) / gcd($carry, $item), 1);

print "Result: $result\n";
