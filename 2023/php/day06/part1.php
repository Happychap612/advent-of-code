<?php
$records = file('./input.data');
// $records = file('./sample.data');

preg_match_all('!\d+!', array_shift($records), $times);
$times = $times[0];
preg_match_all('!\d+!', array_shift($records), $records);
$records = $records[0];

$result = 1;
for ($i = 0; $i < count($times); $i++) {
    $rec = $records[$i];
    $time = $times[$i];

    $solutions = 0;
    for ($t = 1; $t <= $time; $t++) {
        $solutions += ($t * ($time - $t)) > $rec;
    }
    $result *= $solutions;
}

print "Result: $result\n";
