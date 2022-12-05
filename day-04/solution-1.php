<?php

$inputFile = 'input.txt';

$data = file("./$inputFile", FILE_IGNORE_NEW_LINES);


$sum = 0;
function isFullyContained($first, $second)
{
    if (
        ($first['low'] <= $second['low'] && $first['high'] >= $second['high'])
    || ($second['low'] <= $first['low'] && $second['high'] >= $first['high'])
    ) {
        return true;
    }

    return false;
}

foreach ($data as $pairs) {
    [$a, $b] = explode(',', $pairs);
    [$first['low'], $first['high']] = explode('-', $a);
    [$second['low'], $second['high']] = explode('-', $b);

    if (isFullyContained($first, $second)) {
        $sum++;
    }
}

echo $sum . PHP_EOL;
