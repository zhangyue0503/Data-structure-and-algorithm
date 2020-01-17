<?php

for ($i = 0; $i < 8; $i++) {
    $arr[] = rand(1, 10);
}
shuffle($arr);

print_r($arr);

// 简易桶排序
$bucket = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
foreach ($arr as $k => $v) {
    $bucket[$v - 1]++;
}

foreach ($bucket as $k => $v) {
    if ($v) {
        for ($i = 0; $i < $v; $i++) {
            echo $k + 1, PHP_EOL;
        }
    }
}
