<?php

$inputFile = 'input.txt';

$data = file("./$inputFile", FILE_IGNORE_NEW_LINES);

const MOVE = 'move ';
const FROM = 'from ';
const TO = 'to ';

define('MOVE_OFFSET', strlen(MOVE));
define('SRC_STACK_OFFSET', strlen(FROM));
define('DST_STACK_OFFSET', strlen(TO));

function parseInput($data) {
    $stacks = [];
    $moves = [];

    $i = 0;
    foreach ($data as $line) {
        if (strstr($line, '[')) {
            parseStacks($stacks, $line);
        } elseif (strstr($line, 'move')) {
            $moves[] = [
                'count' => (int)substr($line, strpos($line, MOVE) + MOVE_OFFSET),
                'src' => (int)substr($line, strpos($line, FROM) + SRC_STACK_OFFSET),
                'dst' => (int)substr($line, strpos($line, TO) + DST_STACK_OFFSET),
            ];
        }
        $i++;
    }

    ksort($stacks);
    return [$stacks, $moves];
}

function parseStacks(&$stacks, $line) {
    $stackIndex = 0;
    for ($i = 1; $i < strlen($line); $i += 4, $stackIndex++) {
        if ($line[$i] != ' ') {
            if (!isset($stacks[$stackIndex])) {
                $stacks[$stackIndex] = [];
            }
            array_unshift($stacks[$stackIndex], $line[$i]);
        }
    }

    return $stacks;
}

[$stacks, $moves] = parseInput($data);

foreach ($moves as $move) {
    $movingPart = array_splice($stacks[$move['src'] - 1], -$move['count']);
    $stacks[$move['dst'] - 1] = array_merge($stacks[$move['dst'] - 1], $movingPart);
}

foreach ($stacks as $stack) {
    echo array_pop($stack);
}

echo PHP_EOL;

