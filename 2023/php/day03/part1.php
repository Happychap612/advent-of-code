<?php
function getMinMaxRow(int $pos, int $width, int $len) {
    $min = $pos === 0 ? $pos : $pos - 1;
    $max = $min + $len + 2;
    $max = $max > $width ? $width : $max;

    return [$min, $max];
}

$table = file('./input.data');
// $table = file('./input2.data');
// $table = file('./input3.data');
// $table = file('./extra.data');
// $table = file('./extra2.data');
// $table = file('./sample.data');

$result = 0;
$height = count($table);
$width = strlen($table[$height - 1]);

// LOOP THROUGH ROWS AND FIND NUMBERS
for ($y = 0; $y < count($table); $y++) {
    $row = $table[$y];
    preg_match_all('!\d{1,3}!', $row, $matches, PREG_OFFSET_CAPTURE);
    $matches = $matches[0];


    for ($m = 0; $m < count($matches); $m++) {
        $match = $matches[$m][0];
        $pos = $matches[$m][1];
        $continue = false;
        $minMax = getMinMaxRow($pos, $width, strlen($match));

        //ABOVE
        if ($y > 0) {
            $checkRow = $table[$y - 1];
            for ($s = $minMax[0]; $s < $minMax[1]; $s++) {
                if ($checkRow[$s] !== '.' && !is_numeric($checkRow[$s]) && !$continue) {
                    $result += $match;
                    $continue = true;
                }
            }
        }
        if ($continue) {
            continue;
        }

        //SAME
        for ($s = $minMax[0]; $s < $minMax[1]; $s++) {
            if ($row[$s] !== '.' && !is_numeric($row[$s]) && !$continue) {
                $result += $match;
                $continue = true;
            }
        }
        if ($continue) {
            continue;
        }


        //DOWN
        if ($y < $height - 1) {
            $checkRow = $table[$y + 1];
            for ($s = $minMax[0]; $s < $minMax[1]; $s++) {
                if ($checkRow[$s] !== '.' && !is_numeric($checkRow[$s]) && !$continue) {
                    $result += $match;
                    $continue = true;
                }
            }
        }
        if ($continue) {
            continue;
        }
    }
}

print 'Result: ' . $result . PHP_EOL;
