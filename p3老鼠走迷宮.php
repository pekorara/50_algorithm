<?php
$points = [
    [0,-1],
    [1,-1],
    [1,0],
    [1,1],
    [0,1],
    [-1,1],
    [-1,0],
    [-1,-1],
];

$map = [];
for ($i = 0; $i < 8; $i++) {
    $row = explode(' ',trim(readline()));
    $map[] = $row;
}

$memory = [[0,0]];
r(0,0,$memory,$map,$points);
foreach ($memory as [$y,$x]){
    echo "(".$y.','.$x.")" . PHP_EOL;
}

function r($px, $py, &$memory, $map, $points) {
    if ($px == 7 && $py == 7) return true;

    for ($i = 0; $i < count($points); $i++) {
        [$x, $y] = $points[$i];
        $dx = $px + $x;
        $dy = $py + $y;

        if ($dx < 0 || $dx >= 8 || $dy < 0 || $dy >= 8) continue;
        if ($map[$dy][$dx] == 1) continue;
        if (in_array([$dy, $dx], $memory)) continue;

        $memory[] = [$dy, $dx];

        if (r($dx, $dy, $memory, $map, $points)) return true;

        array_pop($memory);
    }
    return false;
}