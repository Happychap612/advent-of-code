<?php

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
