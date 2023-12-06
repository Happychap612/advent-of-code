<?php 
function getMinMaxRow(int $pos, int $width, int $len) {
    $min = $pos === 0 ? $pos : $pos - 1;
    $max = $min + $len + 1;
    $max = $max > $width ? $width : $max;

    return [$min, $max];
}