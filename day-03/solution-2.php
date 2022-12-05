<?php

$inputFile = 'input.txt';

$data = file("./$inputFile", FILE_IGNORE_NEW_LINES);

function getCommonItem(string $a, string $b, string $c): string {
    $common = array_intersect(str_split($a), str_split($b), str_split($c));
    return array_pop($common);
}

function getPriority(string $a) {
    $dec = ord($a);

    if ($dec > 90) {
        return $dec - 96;
    } else {
        return $dec - 38;
    }
}

$sum = 0;
for ($i = 0; $i < count($data); $i += 3) {
    $group = array_slice($data, $i, 3);

    $common = getCommonItem($group[0], $group[1], $group[2]);
    $sum += getPriority($common);
}

echo $sum . PHP_EOL;
