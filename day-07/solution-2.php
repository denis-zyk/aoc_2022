<?php

$inputFile = 'input.txt';

$data = file("./$inputFile", FILE_IGNORE_NEW_LINES);

const CHANGE_DIR = '$ cd ';
const TOTAL = 70000000;
const NEEDED = 30000000;

function parseInput($data)
{
    $dirSizes = [];
    $curDir = '';
    foreach ($data as $line) {
        if (strpos($line, CHANGE_DIR) === 0) {
            $dir = substr($line, strlen(CHANGE_DIR));
            switch ($dir) {
                case '..':
                    $curDir = substr($curDir, 0, strrpos($curDir, '/'));
                    break;
                default:
                    $curDir = rtrim($curDir, '/') .  '/' . ltrim($dir, '/');
                    $dirSizes[$curDir] = 0;
                    break;
            }
        } elseif (is_numeric($line[0])) {
            $dirSizes[$curDir] += (int)$line;
            foreach ($dirSizes as $dirPath => $dirSize) {
                if ($dirPath !== $curDir && strpos($curDir, $dirPath) === 0) {
                    $dirSizes[$dirPath] += (int)$line;
                }
            }
        }
    }

    return $dirSizes;
}

$results = parseInput($data);
$needToFree = NEEDED - (TOTAL - $results['/']);

$results = array_filter($results, function ($value) use ($needToFree) {
    return $value >= $needToFree;
});
sort($results);

echo array_shift($results) . PHP_EOL;

