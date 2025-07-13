<?php
$n = (int)trim(readline());
$p = [];

list($row, $col) = explode(' ', trim(readline()));
$p[] = (int)$row;
$p[] = (int)$col;

for ($i = 1; $i < $n; $i++) {
    list($r, $c) = explode(' ', trim(readline()));
    $p[] = (int)$c;
}

$dp = [];
$s = [];
for ($i = 1; $i <= $n; $i++) {
    $dp[$i][$i] = 0;
}

for ($l = 2; $l <= $n; $l++) {
    for ($i = 1; $i <= $n - $l + 1; $i++) {
        $j = $i + $l - 1;
        $dp[$i][$j] = PHP_INT_MAX;
        for ($k = $i; $k < $j; $k++) {
            $cost = $dp[$i][$k] + $dp[$k+1][$j] + $p[$i-1]*$p[$k]*$p[$j];
            if ($cost < $dp[$i][$j]) {
                $dp[$i][$j] = $cost;
                $s[$i][$j] = $k;
            }
        }
    }
}

echo "最少運算次數: " . $dp[1][$n] . PHP_EOL;

// 印出最佳括號
function printOrder($i, $j, $s) {
    if ($i == $j) {
        echo "M" . $i . '';
    } else {
        echo "(";
        printOrder($i, $s[$i][$j], $s);
        printOrder($s[$i][$j]+1, $j, $s);
        echo ")";
    }
}

echo "最佳括號: ";
printOrder(1, $n, $s);
echo PHP_EOL;