<?php
$lines = file(__DIR__ . '/input.txt', FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
$start = array_shift($lines);
$start = explode(' ', $start);
$start = (int) $start[1];
$instructions = array_map(function($line) {
    return explode(' ', $line);
}, $lines);
$register = [1, 0, 0, 0, 0, 0];
function executeInstruction($instruction, $a, $b, $c, &$register, &$start)
{
    switch ($instruction) {
        case 'addr':
            $register[$c] = (int) $register[$a] + (int) $register[$b];
            break;
        case 'addi':
            $register[$c] = (int) $register[$a] + (int) $b;
            break;
        case 'mulr':
            $register[$c] = (int) $register[$a] * (int) $register[$b];
            break;
        case 'muli':
            $register[$c] = (int) $register[$a] * (int) $b;
            break;
        case 'banr':
            $register[$c] = (int) $register[$a] & (int) $register[$b];
            break;
        case 'bani':
            $register[$c] = (int) $register[$a] & (int) $b;
            break;
        case 'borr':
            $register[$c] = (int) $register[$a] | (int) $register[$b];
            break;
        case 'bori':
            $register[$c] = (int) $register[$a] | (int) $b;
            break;
        case 'setr':
            $register[$c] = (int) $register[$a];
            break;
        case 'seti':
            $register[$c] = (int) $a;
            break;
        case 'gtir':
            $register[$c] = (int) $a > (int) $register[$b] ? 1 : 0;
            break;
        case 'gtri':
            $register[$c] = (int) $register[$a] > (int) $b ? 1 : 0;
            break;
        case 'gtrr':
            $register[$c] = (int) $register[$a] > (int) $register[$b] ? 1 : 0;
            break;
        case 'eqir';
            $register[$c] = (int) $a === (int) $register[$b] ? 1 : 0;
            break;
        case 'eqri':
            $register[$c] = (int) $register[$a] === (int) $b ? 1 : 0;
            break;
        case 'eqrr':
            $register[$c] = (int) $register[$a] === (int) $register[$b] ? 1 : 0;
            break;
    }
}
$escaped = false;
$i = 0;
do {
    if ($i < count($instructions)) {
        executeInstruction(
            $instructions[$i][0],
            $instructions[$i][1],
            $instructions[$i][2],
            $instructions[$i][3],
            $register,
            $start
        );
        $i = ++$register[$start];
    } else {
        $escaped = true;
    }
} while(!$escaped);
var_dump($register);