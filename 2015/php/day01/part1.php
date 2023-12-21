<?php
$data = file("../../data/day01/input.data");

$floor = 0;
$floorData = $data[0];
$floor += substr_count($floorData, '(');
$floor -= substr_count($floorData, ')');

print "$floor\n";
