<?php

$numbers = [49, 38, 65, 97, 76, 13, 27, 49];

echo implode(', ', $numbers), PHP_EOL;

function InsertSort($arr)
{
    $n = count($arr);
    for ($i = 1; $i < $n; $i++) { // 开始循环，从第二个元素开始，下标为 1 的
        $tmp = $arr[$i]; // 取出未排序序列第一个元素
        for ($j = $i; $j > 0 && $arr[$j - 1] > $tmp; $j--) { // 判断从当前下标开始向前判断，如果前一个比当前元素大
            $arr[$j] = $arr[$j - 1]; // 依次移动元素
        }
        // 将元素放到合适的位置
        $arr[$j] = $tmp;
    }
    echo implode(', ', $arr), PHP_EOL;
}

InsertSort($numbers);

function ShellSort($arr)
{
    $n = count($arr);
    $sedgewick = [5, 3, 1];

    // 初始的增量值不能超过待排序列的长度
    for ($si = 0; $sedgewick[$si] >= $n; $si++); 

    // 开始分组循环，依次按照 5 、3 、 1 进行分组
    for ($d = $sedgewick[$si]; $d > 0; $d = $sedgewick[++$si]) {
        // 获取当前的分组数量
        for ($p = $d; $p < $n; $p++) {
            $tmp = $arr[$p];
            // 插入排序开始，在当前组内
            for ($i = $p; $i >= $d && $arr[$i - $d] > $tmp; $i -= $d) {
                $arr[$i] = $arr[$i - $d];
            }
            $arr[$i] = $tmp;
        }
    }
    echo implode(', ', $arr), PHP_EOL;
}
ShellSort($numbers);
