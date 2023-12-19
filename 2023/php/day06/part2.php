<?php
$records = file('./input.data');
// $records = file('./sample.data');

preg_match_all('!\d+!', array_shift($records), $time);
$time = implode("", $time[0]);
preg_match_all('!\d+!', array_shift($records), $record);
$record = implode("", $record[0]);

$result = 1;
$solutions = 0;
for ($t = 1; $t <= $time; $t++) {
    $solutions += ($t * ($time - $t)) > $record;
}
$result *= $solutions;

print "Result: $result\n";
