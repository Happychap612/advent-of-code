<?php
include './util.php';
$dataDir = "../../data/day11";
$universe = file("$dataDir/input.data");
// $universe = file("$dataDir/sample.data");

$res = 0;
$galaxies = [];
$height = count($universe);
$width = strlen($universe[count($universe) - 1]);

$universeExpansionRate = 1000000;

// columns where there are galaxies so we know which ones to increase later
$xMatches = [];
$xEmpty = [];
$yEmpty = [];

// Loop through the universe and find any 
for ($y = 0; $y < $height; $y++) {
    preg_match_all('/\#/', $universe[$y], $g, PREG_OFFSET_CAPTURE);
    $g = $g[0];
    for ($z = 0; $z < count($g); $z++) {
        $xMatches[$g[$z][1]] = $g[$z][1];
    }
    if (count($g) == 0) {
        $yEmpty[] = $y;
    }
}

//List of columns where no galaxies are found ever
for ($i = 0; $i < $width; $i++) {
    if (!array_key_exists($i, $xMatches)) {
        $xEmpty[] = $i;
    }
}
$xEmpty = array_values($xEmpty);


// now go find our galaxies
for ($y = 0; $y < count($universe); $y++) {
    preg_match_all('/\#/', $universe[$y], $shiny, PREG_OFFSET_CAPTURE);
    $g = $shiny[0];
    for ($z = 0; $z < count($g); $z++) {
        $galaxies[] = [$g[$z][1], $y];
    }
}

$uniquePairs = calculatePairs(count($galaxies));

for ($p = 0; $p < count($uniquePairs); $p++) {
    $x = $uniquePairs[$p];
    $a = $galaxies[$x[0]];
    $b = $galaxies[$x[1]];

    $r = 0;

    for ($i = 0; $i < count($xEmpty); $i++) {
        $m = $xEmpty[$i];

        $min = min($a[0], $b[0]);
        $max = max($a[0], $b[0]);
        if ($min <= $m && $m <= $max) {
            $r += $universeExpansionRate - 1;
        }
    }

    for ($i = 0; $i < count($yEmpty); $i++) {
        $m = $yEmpty[$i];

        $min = min($a[1], $b[1]);
        $max = max($a[1], $b[1]);
        if ($min <= $m && $m <= $max) {
            $r += $universeExpansionRate - 1;
        }
    }

    $r += abs($a[0] - $b[0]) + abs($a[1] - $b[1]);
    $res += $r;
}

print "Result: $res\n";
