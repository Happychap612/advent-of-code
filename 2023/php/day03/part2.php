<?php
 
$table = file('./input.data');
// $table = file('./input2.data');
// $table = file('./input3.data');
// $table = file('./extra.data');
// $table = file('./extra2.data');
// $table = file('./extra3.data');
// $table = file('./sample.data');

$result = 0;
$height = count($table);
$width = strlen($table[$height - 1]);

for ($y = 0; $y < count($table); $y++) {
    preg_match_all('/\*/', $table[$y], $matches, PREG_OFFSET_CAPTURE);
    $matches = $matches[0];
    if (count($matches) == 0) {
        continue;
    }

    $checkRows = [];
    if ($y > 0) {
        $checkRows[] = $table[$y - 1];
    }
    $checkRows[] = $table[$y];
    if ($y < $height - 1) {
        $checkRows[] = $table[$y + 1];
    }


    for ($m = 0; $m < count($matches); $m++) {
        $match = $matches[$m][0];
        $pos = $matches[$m][1];
        $min = $pos === 0 ? $pos : $pos - 1;
        $max = $pos === ($width - 1) ? $pos : $pos + 1;

        $partCountForGear = 0; // the count of part numbers we've found for this gear
        $partsForGear = []; // the list of part numbers we've found for this gear

        for ($r = 0; $r < count($checkRows); $r++) {
            $row = $checkRows[$r];
            $slice = substr($row, $min, 3);
            preg_match_all('/\d{1,3}/', $slice, $sm, PREG_OFFSET_CAPTURE);

            if (count($sm[0]) > 0) {
                for ($smi = 0; $smi < count($sm[0]); $smi++) {
                    $smAP = $min + $sm[0][$smi][1]; //Slice Match Actual Pos
                    $smAL = strlen($sm[0][$smi][0]); //Slice Match Actual Length

                    $checkSlice = substr($row, $smAP - 1, $smAL);
                    while (!preg_match('/\./', $checkSlice) && is_numeric($checkSlice) && $smAP !== 0) {
                        $smAP--;
                        $smAL++;
                        $checkSlice = substr($row, $smAP - 1, $smAL); // setup next checkSlice
                    }

                    $checkSlice = substr($row, $smAP, $smAL + 1); // && ($smAP + $smAL) <= $max
                    while (!preg_match('/\./', $checkSlice) && is_numeric($checkSlice) && ($smAP + $smAL) !== $width) {
                        $smAL++;
                        $checkSlice = substr($row, $smAP, $smAL + 1); // setup next checkSlice
                    }

                    $partCountForGear++;
                    $partsForGear[] = substr($row, $smAP, $smAL);
                }
            }
        }

        // checked all the rows for that gear
        if ($partCountForGear == 2) {
            $result += $partsForGear[0] * $partsForGear[1];
        }
    }
}

print "Result: $result\n";
