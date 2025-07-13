<?php
$count = (int)readline();
$result = [];
for ($i = 0; $i < $count; $i++) {
    $line = trim(readline());
    if(!preg_match('/^[\d\- ]+$/',$line)){
        $result[] = 'N';
        continue;
    }
    $list = str_split(str_replace(['-',' '],'',$line));
    $last = (int)end($list);
    $list = array_slice($list,0,-1);
    $sum = 0;
    foreach ($list as $k => $v){
        if($k % 2 === 0){
            $sum += (int)$v;
        }else{
            $sum += (int)$v * 3;
        }
    }
    $sum = $sum % 10;
    $n = 10 - $sum;
    if($n === 10) $n = 0;
    if($n === $last){
        $result[] = 'Y';
    }else{
        $result[] = 'N';
    }
}

foreach ($result as $data){
    echo $data . PHP_EOL;
}