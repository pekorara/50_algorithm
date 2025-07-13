<?php
$count = (int)trim(readline());
$result = [];
$dic = [
    ']' => '[',
    ')' => '(',
    '}' => '{',
];
for ($i = 0; $i < $count; $i++) {
    $stack = [];
    $lines = str_split(trim(readline()));
    $flag = true;
    foreach ($lines as $line){
        if($line === '[' || $line === '(' || $line === '{'){
            $stack[] = $line;
        }else{
            if(count($stack) !== 0 && $dic[$line] === end($stack)){
                array_pop($stack);
            }else{
                $flag = false;
                break;
            }
        }
    }

    if(count($stack) !== 0 || !$flag){
        $result[] = 'N';
        $flag = false;
    }

    if ($flag){
        $result[] = 'Y';
    }
}

foreach ($result as $data){
    echo $data . PHP_EOL;
}