<?php
$records = file('./input.data');
// $records = file('./sample.data');

$time = array_shift($records);
$record = array_shift($records);
unset($records);

preg_match_all('!\d+!', $time, $time);
$times = $time[0];
preg_match_all('!\d+!', $record, $record);
$records = $record[0];

$raceRecords = [];

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
