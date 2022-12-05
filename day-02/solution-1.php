<?php

$inputFile = 'input.txt';

$data = file("./$inputFile", FILE_IGNORE_NEW_LINES);

$elfCalories = [];
$elfIndex = 0;

const ROCK = 1;
const PAPER = 2;
const SCISSORS = 3;

$opponentMoves = [
    'A' => ROCK, // rock
    'B' => PAPER, // paper
    'C' => SCISSORS, // scissors
];

$myMoves = [
    'X' => ROCK, // rock
    'Y' => PAPER, // paper
    'Z' => SCISSORS, // scissors
];

$movesScores = [
    ROCK => 1,
    PAPER => 2,
    SCISSORS => 3,
];

const LOST = 0;
const DRAW = 3;
const WON = 6;

function roundResult($my, $opponent) {
    $result = 0;

    if ($my == $opponent) {
        $result = DRAW;
    } elseif (
        ($my == ROCK && $opponent == SCISSORS)
        || ($my == SCISSORS && $opponent == PAPER)
        || ($my == PAPER && $opponent == ROCK)
    ) {
        $result = WON;
    } else{
        $result = LOST;
    }

    return $result;
}

$totalScore = 0;
foreach ($data as $round) {
    [$opponent, $me] = explode(' ', $round);
    $myMove = $myMoves[$me];
    $opMove = $opponentMoves[$opponent];

    $totalScore += roundResult($myMove, $opMove) + $movesScores[$myMove];
}

echo $totalScore . PHP_EOL;
