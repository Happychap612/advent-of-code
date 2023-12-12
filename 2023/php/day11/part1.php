<?php
$universe = file('./input.data');
// $universe = file('./sample.data');

$res = 0;
$galaxies = [];
$width = 0;

function calculatePairs($x)
{
    $pairs = [];

    for ($i = 1; $i <= $x - 1; $i++) {
        for ($j = $i + 1; $j <= $x; $j++) {
            // minus one so it's just array points :)
            $pairs[] = array($i - 1, $j - 1);
        }
    }

    return $pairs;
}

// columns where there are galaxies so we know which ones to increase later
$xMatches = [];

// Loop through the universe and find any 
for ($y = 0; $y < count($universe); $y++) {
    preg_match_all('/\#/', $universe[$y], $g, PREG_OFFSET_CAPTURE);
    $g = $g[0];
    for ($z = 0; $z < count($g); $z++) {
        $xMatches[$g[$z][1]] = $g[$z][1];
    }
    if (count($g) == 0) {
        // splice the new rows in if no galaxies in that row
        array_splice($universe, $y, 0, $universe[$y]);
        $y++;
    }
    $width = strlen($universe[$y]);
}

//List of columns where no galaxies are found ever so we know where to insert the new columns
$xMod = [];
for ($i = 0; $i < $width; $i++) {
    if (!array_key_exists($i, $xMatches)) {
        $xMod[] = $i;
    }
}
arsort($xMod); // reverse order so inserting the in column 2 doesn't mess with the position of column 3
$xMod = array_values($xMod);

// loop through xMod to modify each universe row with new columns
for ($y = 0; $y < count($universe); $y++) {
    for ($x = 0; $x < count($xMod); $x++) {
        $universe[$y] = substr($universe[$y], 0, $xMod[$x]) . "." . substr($universe[$y], $xMod[$x]);
    }
}

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

    $r = abs($a[0] - $b[0]) + abs($a[1] - $b[1]);
    $res += $r;
}

print "Result: $res\n";
