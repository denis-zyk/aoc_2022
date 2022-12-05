<?php

$inputFile = 'input.txt';

$data = file("./$inputFile", FILE_IGNORE_NEW_LINES);

function getCommonItem(string $a, string $b): string {
    $common = array_intersect(str_split($a), str_split($b));
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
foreach ($data as $rucksack) {
    $middle = strlen($rucksack) / 2;
    $a = substr($rucksack, 0, $middle);
    $b = substr($rucksack, -$middle);

    $common = getCommonItem($a, $b);
    $sum += getPriority($common);
}

echo $sum . PHP_EOL;
