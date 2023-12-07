<?php

// $table = file('./input.data');
// $table = file('./input2.data');
// $table = file('./input3.data');
// $table = file('./extra.data');
// $table = file('./extra2.data');
$table = file('./sample.data');

$result = 0;
$height = count($table);
$width = strlen($table[$height - 1]);

// LOOP THROUGH ROWS AND FIND NUMBERS
for ($y = 0; $y < count($table); $y++) {
    $row = $table[$y];
    preg_match_all('!\*!', $row, $matches, PREG_OFFSET_CAPTURE);
    $matches = $matches[0];


    for ($m = 0; $m < count($matches); $m++) {
        $match = $matches[$m][0];
        $pos = $matches[$m][1];
        $min = $min = $pos === 0 ? $pos : $pos - 1;

        $noOfMatches = 0;
        $matched = [];

        //ABOVE
        if ($y > 0) {
            $checkRow = $table[$y - 1];
            $searchString = substr($checkRow, $min, 3);
            preg_match_all('!\d!', $row, $no, PREG_OFFSET_CAPTURE);
        }
        if ($continue) {
            $matchNo++;
            continue;
        }
}

print 'Result: ' . $result . PHP_EOL;
print 'Count: ' . $matchNo . PHP_EOL;
print 'Result: ' . $noResult . PHP_EOL;
print 'Count: ' . $noMatchNo . PHP_EOL . PHP_EOL;
