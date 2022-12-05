<?php

$inputFile = 'input.txt';

$data = file("./$inputFile", FILE_IGNORE_NEW_LINES);


$sum = 0;
function isOverlapping($first, $second)
{
    if (
        ($first['low'] >= $second['low'] && $first['low'] <= $second['high'])
        || ($first['high'] >= $second['low'] && $first['high'] <= $second['high'])
    ) {
        return true;
    }

    return false;
}

foreach ($data as $pairs) {
    [$a, $b] = explode(',', $pairs);
    [$first['low'], $first['high']] = explode('-', $a);
    [$second['low'], $second['high']] = explode('-', $b);

    if (isOverlapping($first, $second) || isOverlapping($second, $first)) {
        $sum++;
    }
}

echo $sum . PHP_EOL;
