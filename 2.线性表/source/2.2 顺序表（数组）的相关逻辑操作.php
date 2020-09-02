<?php

/**
 * 查找
 * @param array $list 顺序表数组
 * @param mixed $e 数组元素
 * return int 查找结果下标
 */
function LocateElem(array $list, $e)
{
    $c = count($list);
    for ($i = 0; $i < $c; $i++) {
        if ($list[$i] == $e) {
            return $i;
        }
    }
    return -1;
}

/**
 * 数组插入
 * @param array $list 顺序表数组
 * @param int $i 插入数据下标
 * @param mixed $e 数组元素
 * return bool 成功失败结果
 */
function ListInsert(array &$list, int $i, $e)
{
    $c = count($list);
    if ($i < 0 || $i > $c) {
        return false;
    }

    $j = $c - 1;
    while ($j >= $i) {
        // 从后往前，下一个位置的值变成现在这个位置的值
        // 数据向后挪动
        $list[$j + 1] = $list[$j];
        $j--;
    }
    // 在指定位置插入值
    $list[$i] = $e;
    return true;
}

/**
 * 删除指定下标元素
 * @param array $list 顺序表数组
 * @param int $i 插入数据下标
 * return bool 成功失败结果
 */
function ListDelete(array &$list, int $i)
{
    $c = count($list);
    if ($i < 0 || $i > $c - 1) {
        return false;
    }

    $j = $i;
    while ($j < $c) {
        // 当前位置的值变成下一个位置的值
        // 数据向前挪动
        $list[$j] = $list[$j+1];
        $j++;
    }
    // 去掉最后一个数据
    unset($list[$c - 1]);
    return true;
}

$arr = [1, 2, 3, 4, 5, 6, 7];

ListInsert($arr, 3, 55);
print_r($arr);
// Array
// (
//     [0] => 1
//     [1] => 2
//     [2] => 3
//     [3] => 55
//     [4] => 4
//     [5] => 5
//     [6] => 6
//     [7] => 7
// )

$arr = [1, 2, 3, 4, 5, 6, 7];
ListDelete($arr, 5);
print_r($arr);
// Array
// (
//     [0] => 1
//     [1] => 2
//     [2] => 3
//     [3] => 4
//     [4] => 5
//     [5] => 7
// )

$arr = [1, 2, 3, 4, 5, 6, 7];
$index = LocateElem($arr, 6);
echo $index, PHP_EOL;
// 5
