<?php
// 讀取測試資料
$m = (int)trim(readline()); // 面向數量
$categories = [];
for ($i = 0; $i < $m; $i++) {
    $categories[] = trim(readline());
}

$n = (int)trim(readline()); // 原料數量
$materials = [];

// 初始化每個面向的原料列表
foreach ($categories as $cat) {
    $materials[$cat] = [];
}

// 建立原料清單
for ($i = 0; $i < $n; $i++) {
    [$t1, $t2, $t3] = explode(' ', trim(readline()));
    $materials[$t1][] = ['name' => $t2, 'price' => (int)$t3, 'order' => $i];
}

// 使用遞迴產生所有組合
function generateCombinations($materials, $categories, $index = 0, $current = []) {
    if ($index == count($categories)) {
        yield $current;
        return;
    }
    $category = $categories[$index];
    foreach ($materials[$category] as $item) {
        yield from generateCombinations($materials, $categories, $index + 1, array_merge($current, [$item]));
    }
}

// 收集結果
$results = [];
foreach (generateCombinations($materials, $categories) as $combo) {
    $total = array_sum(array_column($combo, 'price'));
    $names = array_column($combo, 'name');
    $orders = array_column($combo, 'order');
    $results[] = ['total' => $total, 'names' => $names, 'orders' => $orders];
}

// 排序：先依總價升序，再依原料輸入順序升序
usort($results, function($a, $b) {
    if ($a['total'] != $b['total']) {
        return $a['total'] - $b['total'];
    }
    return $a['orders'] <=> $b['orders'];
});

// 輸出
foreach ($results as $r) {
    echo $r['total'] . ' ' . implode(' ', $r['names']) . PHP_EOL;
}