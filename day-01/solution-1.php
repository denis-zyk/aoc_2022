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

echo max($elfCalories) . PHP_EOL;