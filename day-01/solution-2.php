<?php

$inputFile = 'input.txt';

$data = file("./$inputFile");

$elfCalories = [];
$elfIndex = 0;
foreach ($data as $calories) {
    $calories = trim($calories);

    if (!$calories) {
        $elfIndex++;
        continue;
    }

    if (!isset($elfCalories[$elfIndex])) {
        $elfCalories[$elfIndex] = 0;
    }

    $elfCalories[$elfIndex] += (int)$calories;
    echo "elf $elfIndex total calories {$elfCalories[$elfIndex]}\n";
}

sort($elfCalories);
$topThreeMax = array_sum(array_slice($elfCalories, -3));

echo $topThreeMax . PHP_EOL;