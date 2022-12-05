<?php

$inputFile = 'input.txt';

$data = file("./$inputFile", FILE_IGNORE_NEW_LINES);

$elfCalories = [];
$elfIndex = 0;

const ROCK = 1;
const PAPER = 2;
const SCISSORS = 3;

const LOST = 0;
const DRAW = 3;
const WON = 6;

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

$roundOutcome = [
    'X' => LOST,
    'Y' => DRAW,
    'Z' => WON,
];

$movesScores = [
    ROCK => 1,
    PAPER => 2,
    SCISSORS => 3,
];

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

function getMyMoveScore($opponent, $roundResult) {
    $result = 0;

    if ($roundResult == DRAW) {
        $result = $opponent;
    } elseif ($roundResult == WON) {
        switch ($opponent) {
            case ROCK:
                $result = PAPER;
                break;

            case PAPER:
                $result = SCISSORS;
                break;

            case SCISSORS:
                $result = ROCK;
                break;
        }
    } elseif ($result == LOST) {
        switch ($opponent) {
            case ROCK:
                $result = SCISSORS;
                break;

            case PAPER:
                $result = ROCK;
                break;

            case SCISSORS:
                $result = PAPER;
                break;
        }
    }

    return $result;
}

$totalScore = 0;
foreach ($data as $round) {
    [$opponent, $roundResult] = explode(' ', $round);
    $opMove = $opponentMoves[$opponent];

    $myMove = getMyMoveScore($opMove, $roundOutcome[$roundResult]);

    $totalScore += $myMove + roundResult($myMove, $opMove);
}

echo $totalScore . PHP_EOL;
