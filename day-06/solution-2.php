<?php

$inputFile = 'input.txt';

$data = file("./$inputFile", FILE_IGNORE_NEW_LINES);

const MARKER_LEN = 14;

function parseInput($data) {
    $results = [];
    foreach ($data as $line) {
        $results[] = findMarkerPos($line) + MARKER_LEN;
    }

    return $results;
}

function findMarkerPos($line)
{
    for ($i = 0; $i < strlen($line); $i++) {
        $marker = substr($line, $i, MARKER_LEN);
        $chars = str_split($marker);

        $charCount = [];
        $found = true;
        foreach ($chars as $char) {
            if (!isset($charCount[$char])) {
                $charCount[$char] = 0;
            }

            $charCount[$char]++;
            if ($charCount[$char] > 1) {
                $found = false;
                break;
            }
        }

        if ($found) {
            return $i;
        }
    }

    throw new Exception("couldn't find marker pos!");
}

$results = parseInput($data);


echo implode("\n", $results) . PHP_EOL;
